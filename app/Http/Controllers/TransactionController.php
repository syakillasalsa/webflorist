<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\Bouquet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;


class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('user_id', Auth::id())->get();
        return view('halaman.transactions', compact('transactions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'total_amount' => 'required|numeric',
            'payment_method' => 'required|string',
            'delivery_method' => 'required|string',
            'address' => 'nullable|string',
            'note' => 'nullable|string',
            'pickup_date' => 'nullable|date',
            'pickup_time' => 'nullable|string',
            'delivery_date' => 'nullable|date',
            'delivery_time' => 'nullable|string',
        ]);

        $shippingCost = $request->delivery_method === 'delivery' ? 15000 : 0;
        $totalPayment = $request->total_amount + $shippingCost;

        Transaction::create([
            'user_id' => auth()->id(),
            'bouquet_id' => null,
            'total_amount' => $request->total_amount,
            'shipping_cost' => $shippingCost,
            'total_payment' => $totalPayment,
            'payment_method' => $request->payment_method,
            'status' => 'Success',
            'delivery_method' => $request->delivery_method,
            'address' => $request->address,
            'note' => $request->note,
            'pickup_date' => $request->pickup_date,
            'pickup_time' => $request->pickup_time,
            'delivery_date' => $request->delivery_date,
            'delivery_time' => $request->delivery_time,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil disimpan!');
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'shipping_method' => 'required|in:pickup,delivery',
            'address' => 'nullable|string',
            'note' => 'nullable|string',
            'pickup_date' => 'nullable|date',
            'pickup_time' => 'nullable|string',
            'delivery_date' => 'nullable|date',
            'delivery_time' => 'nullable|string',
        ]);

        $shippingCost = $request->shipping_method === 'delivery' ? 15000 : 0;

        session([
            'checkout_data' => [
                'shipping_method' => $request->shipping_method,
                'address' => $request->address,
                'note' => $request->note,
                'shipping_cost' => $shippingCost,
                'pickup_date' => $request->pickup_date,
                'pickup_time' => $request->pickup_time,
                'delivery_date' => $request->delivery_date,
                'delivery_time' => $request->delivery_time,
            ]
        ]);

        return redirect()->route('payment');
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:bank_transfer,qris,pay_in_store',
        ]);

        try {
            $cart = session('cart', []);
            $checkout = session('checkout_data', []);
            $user = Auth::user();

            if (empty($cart)) {
                return back()->with('error', 'Keranjang belanja kosong.');
            }

            DB::beginTransaction();

            $shippingCost = $checkout['shipping_cost'] ?? 0;
            $totalAmount = 0;

            $transaction = Transaction::create([
                'user_id' => $user->id,
                'total_amount' => 0,
                'shipping_cost' => $shippingCost,
                'total_payment' => 0,
                'payment_method' => $request->payment_method,
                'status' => 'Success',
                'delivery_method' => $checkout['shipping_method'] ?? null,
                'address' => $checkout['address'] ?? null,
                'note' => $checkout['note'] ?? null,
                'pickup_date' => $checkout['pickup_date'] ?? null,
                'pickup_time' => $checkout['pickup_time'] ?? null,
                'delivery_date' => $checkout['delivery_date'] ?? null,
                'delivery_time' => $checkout['delivery_time'] ?? null,
            ]);

            foreach ($cart as $id => $item) {
                $bouquet = Bouquet::find($id);
                if (!$bouquet) {
                    DB::rollBack();
                    return back()->with('error', 'Bouquet tidak ditemukan.');
                }

                $subtotal = $item['price'] * $item['quantity'];
                $totalAmount += $subtotal;

                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'bouquet_id' => $id,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => $subtotal
                ]);
            }

            $transaction->update([
                'total_amount' => $totalAmount,
                'total_payment' => $totalAmount + $shippingCost
            ]);

            DB::commit();

            session()->forget(['cart', 'checkout_data']);

            return redirect()->route('payment.success', $transaction->id);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat menyimpan transaksi.');
        }
    }

    public function showSuccess()
    {
        $user = Auth::user();
        $transaction = Transaction::with(['items.bouquet', 'user'])
            ->where('user_id', $user->id)
            ->latest()
            ->first();

        return view('halaman.payment_success', compact('transaction'));
    }

    public function success($transactionId)
    {
        $transaction = Transaction::with(['transactionItems.bouquet', 'user'])->findOrFail($transactionId);
        return view('halaman.payment_success', compact('transaction'));
    }

    public function adminTransactions()
    {
        $transactions = Transaction::with('user')->orderBy('created_at', 'desc')->get();
        return view('halaman.admin_transactions', compact('transactions'));
    }
    public function showDetail($id)
{
    $transaction = Transaction::with(['user', 'transactionItems.bouquet'])->findOrFail($id);
    return view('halaman.payment_success', compact('transaction'));
}
public function download($id)
{
    $transaction = Transaction::with(['transactionItems.bouquet', 'user'])->findOrFail($id);

    $pdf = Pdf::loadView('transactions.pdf', compact('transaction'));

    return $pdf->download('nota-transaksi-' . $transaction->id . '.pdf');
}
}
