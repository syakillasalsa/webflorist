<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\Bouquet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    // Menampilkan daftar transaksi user
    public function index()
    {
        $transactions = Transaction::where('user_id', Auth::id())->get();
        Log::info($transactions->toArray());
        return view('halaman.transactions', compact('transactions'));
    }

    // Menyimpan transaksi langsung (opsional jika tidak pakai cart)
    public function store(Request $request)
    {
        $request->validate([
            'total_amount' => 'required|numeric',
            'payment_method' => 'required|string',
            'delivery_method' => 'required|string',
            'address' => 'nullable|string',
            'note' => 'nullable|string',
        ]);

        $shippingCost = $request->delivery_method === 'delivery' ? 15000 : 0;
        $totalPayment = $request->total_amount + $shippingCost;

        Transaction::create([
            'user_id' => auth()->id(),
            'bouquet_id' => null, // Isi jika perlu
            'total_amount' => $request->total_amount,
            'shipping_cost' => $shippingCost,
            'total_payment' => $totalPayment,
            'payment_method' => $request->payment_method,
            'status' => 'paid',
            'delivery_method' => $request->delivery_method,
            'address' => $request->address,
            'note' => $request->note,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil disimpan!');
    }

    // Simpan data checkout ke session sebelum pembayaran
    public function checkout(Request $request)
    {
        $request->validate([
            'shipping_method' => 'required|in:pickup,delivery',
            'address' => 'nullable|string',
            'note' => 'nullable|string',
        ]);

        $shippingCost = $request->shipping_method === 'delivery' ? 15000 : 0;

        session([
            'checkout_data' => [
                'shipping_method' => $request->shipping_method,
                'address' => $request->address,
                'note' => $request->note,
                'shipping_cost' => $shippingCost,
            ]
        ]);

        return redirect()->route('payment');
    }

    // Proses checkout dan simpan transaksi
    public function processPayment(Request $request)
{
    $request->validate([
        'payment_method' => 'required|in:bank_transfer,qris,cash',
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

        // Simpan transaksi utama (sementara total_amount = 0)
        $transaction = Transaction::create([
            'user_id' => $user->id,
            'total_amount' => 0,
            'shipping_cost' => $shippingCost,
            'total_payment' => 0,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
            'delivery_method' => $checkout['shipping_method'] ?? null,
            'address' => $checkout['address'] ?? null,
            'note' => $checkout['note'] ?? null,
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

    public function showInvoice($id)
    {
        $transaction = Session::get("transaction_{$id}");

        if (!$transaction) {
            return abort(404, 'Transaksi tidak ditemukan.');
        }

        return view('halaman.payment_success', compact('transaction'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:Waiting Verification,Paid,Shipped,Cancelled',
        ]);

        $transaction = Transaction::findOrFail($id);
        $transaction->status = $request->status;
        $transaction->save();

        return back()->with('success', 'Status transaksi berhasil diperbarui.');
    }

    public function success($transactionId)
{
    $transaction = Transaction::with(['transactionItems.bouquet', 'user'])->findOrFail($transactionId);
    return view('halaman.payment_success', compact('transaction'));
}

}
