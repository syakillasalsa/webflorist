<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Bouquet;
use App\Models\Transaction;
use Log;

class CheckoutController extends Controller
{
    // Tambah item ke keranjang
    public function addToCart($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $menu = Bouquet::findOrFail($id);
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $menu->name,
                "price" => $menu->price,
                "quantity" => 1,
                "image" => $menu->image
            ];
        }

        Session::put('cart', $cart);
        return redirect()->route('cart.show')->with('success', 'Item berhasil ditambahkan.');
    }

    // Menampilkan halaman keranjang
    public function showCart()
    {
        $cart = session('cart', []);
        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $cart_note = session('cart_note', '');

        return view('halaman.cart', compact('cart', 'subtotal', 'cart_note'));
    }

    // Simpan catatan pengguna
    public function saveNote(Request $request)
    {
        session(['cart_note' => $request->note]);
        return back()->with('success', 'Catatan tersimpan.');
    }

    // Proses checkout
    public function processCheckout(Request $request)
    {
        $request->validate([
            'shipping_method' => 'required',
            'address' => ['sometimes', 'required_if:shipping_method,delivery'],
        ]);

        $cart = session('cart', []);
        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $shipping_method = $request->shipping_method;
        $address = $shipping_method === 'delivery' ? $request->address : null;

        session(['checkout_data' => [
            'subtotal' => $subtotal,
            'shipping_method' => $shipping_method,
            'address' => $address,
            'note' => $request->note,
            'pickup_date' => $request->pickup_date,
            'pickup_time' => $request->pickup_time,
            'delivery_date' => $request->delivery_date,
            'delivery_time' => $request->delivery_time,
        ]]);

        return redirect()->route('payment.page');
    }

    // Menampilkan halaman pembayaran
    public function paymentPage()
    {
        $checkout_data = session('checkout_data', []);
        return view('halaman.payment', compact('checkout_data'));
    }

    // Mendapatkan ongkir dari API GraphHopper
    public function getShippingCost(Request $request)
    {
        $address = $request->query('address');
        if (!$address) {
            return response()->json(['shipping_cost' => 0]);
        }

        $destination = $this->getCoordinates($address);
        if (!$destination) {
            return response()->json(['shipping_cost' => 15000]);
        }

        $apiKey = config('services.graphhopper.api_key');
        $storeLocation = '-7.5916574,110.7964212'; // Lokasi toko
        $url = "https://graphhopper.com/api/1/route?point=$storeLocation&point=$destination&profile=car&key=$apiKey";

        $response = Http::get($url);
        $data = $response->json();

        $shippingCost = isset($data['paths'][0]['distance'])
            ? max(10000, ($data['paths'][0]['distance'] / 1000) * 2000)
            : 15000;

        session()->put('checkout_data.shipping_cost', (int) $shippingCost);

        return response()->json(['shipping_cost' => $shippingCost]);
    }

    // Konversi alamat ke koordinat
    private function getCoordinates($address)
    {
        $apiKey = config('services.graphhopper.api_key');
        $url = "https://graphhopper.com/api/1/geocode?q=" . urlencode($address) . "&key=$apiKey";

        $response = Http::get($url);
        $data = $response->json();

        return $data['hits'][0]['point']['lat'] . ',' . $data['hits'][0]['point']['lng'] ?? null;
    }

    // Proses pembayaran
    public function processPayment(Request $request)
    {
        Log::info('processPayment() dipanggil');

        $request->validate([
            'payment_method' => 'required|in:bank_transfer,qris,cash',
        ]);

        try {
            $cart = session('cart', []);
            $checkout = session('checkout_data', []);
            $user = Auth::user();

            if (!$cart || empty($cart)) {
                Log::warning('Keranjang kosong, redirect kembali');
                return back()->with('error', 'Keranjang belanja kosong.');
            }

            Log::info('Memulai penyimpanan transaksi');

            foreach ($cart as $id => $item) {
                Transaction::create([
                    'user_id' => $user->id,
                    'bouquet_id' => $id,
                    'total_amount' => $item['price'] * $item['quantity'],
                    'payment_method' => $request->payment_method,
                    'shipping_method' => $checkout['shipping_method'] ?? null,
                    'address' => $checkout['address'] ?? null,
                    'note' => $checkout['note'] ?? null,
                    'pickup_date' => $checkout['pickup_date'] ?? null,
                    'pickup_time' => $checkout['pickup_time'] ?? null,
                    'delivery_date' => $checkout['delivery_date'] ?? null,
                    'delivery_time' => $checkout['delivery_time'] ?? null,
                    'status' => 'pending',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            Log::info('Transaksi berhasil disimpan');

            session()->forget(['cart', 'checkout_data']);
            session()->save();
            Log::info('Session cart & checkout_data dihapus');

            return redirect()->route('transactions.index')->with('success', 'Pembayaran berhasil!');
        } catch (\Exception $e) {
            Log::error('Gagal menyimpan transaksi: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan transaksi.');
        }
    }
}
