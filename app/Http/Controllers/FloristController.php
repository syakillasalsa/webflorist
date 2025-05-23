<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bouquet;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class FloristController extends Controller
{
    public function index()
    {
        $bouquets = Bouquet::all();
        return view('halaman.home', compact('bouquets'));
    }

    public function showOrders()
    {
        $bouquets = Bouquet::all();
        return view('halaman.order', compact('bouquets'));
    }

    public function about()
    {
        return view('halaman.about');
    }

    public function create()
    {
        return view('halaman.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric',
            'category'    => 'required|in:Bunga,Buket,Kertas',
            'image'       => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $imagePath = $request->file('image')->store('bouquet_images', 'public');

        Bouquet::create([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'category'    => $request->category,
            'image'       => $imagePath
        ]);

        return redirect()->route('order.index')->with('success', 'Buket bunga berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $bouquet = Bouquet::findOrFail($id);
        return view('halaman.edit', compact('bouquet'));
    }

    public function update(Request $request, $id)
    {
        $bouquet = Bouquet::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric',
            'category'    => 'required|in:Bunga,Buket,Kertas',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $bouquet->name        = $request->name;
        $bouquet->description = $request->description;
        $bouquet->price       = $request->price;
        $bouquet->category    = $request->category;

        if ($request->hasFile('image')) {
            if ($bouquet->image) {
                Storage::delete('public/' . $bouquet->image);
            }
            $imagePath = $request->file('image')->store('bouquet_images', 'public');
            $bouquet->image = $imagePath;
        }

        $bouquet->save();

        return redirect()->route('order.index')->with('success', 'Buket bunga berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $bouquet = Bouquet::findOrFail($id);

        if ($bouquet->image) {
            Storage::delete('public/' . $bouquet->image);
        }

        $bouquet->delete();

        return redirect()->route('order.index')->with('success', 'Buket bunga berhasil dihapus!');
    }

    public function menu(Request $request)
    {
        $category = $request->get('category');

        $bouquets = $category
            ? Bouquet::where('category', $category)->get()
            : Bouquet::all();

        return view('halaman.menu', compact('bouquets'));
    }

    public function updateCategory(Request $request, $id)
    {
        $bouquet = Bouquet::findOrFail($id);
        $request->validate([
            'category' => 'required|in:Bunga,Buket,Kertas'
        ]);

        $bouquet->category = $request->category;
        $bouquet->save();

        return redirect()->route('order.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function removeItem($id)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }

        return redirect()->route('cart.show')->with('success', 'Item berhasil dihapus dari keranjang.');
    }

    public function increase($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
            session()->put('cart', $cart);
        }
        return redirect()->back();
    }

    public function decrease($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            if ($cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity']--;
            } else {
                unset($cart[$id]);
            }
            session()->put('cart', $cart);
        }
        return redirect()->back();
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        $subtotal = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
        $cartNote = session()->get('cart_note', '');

        return view('halaman.checkout', compact('cart', 'subtotal', 'cartNote'));
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'payment_method' => 'required',
            'address' => 'required'
        ]);

        session()->forget('cart');

        return redirect()->route('order.success')->with('success', 'Pembayaran berhasil! Pesanan sedang diproses.');
    }

    public function saveNote(Request $request)
    {
        Session::put('cart_note', $request->note);
        return redirect()->route('cart')->with('success', 'Catatan berhasil disimpan.');
    }

    public function adminHome()
{
    // Pastikan user yang login adalah admin
    if (Auth::check() && Auth::user()->role === 'admin') {

        // Ambil data statistik
        $totalMenu = Bouquet::count();
        $totalTransactions = Transaction::count();
        $totalAdmins = User::where('role', 'admin')->count();
        $recentActivities = Transaction::latest()->take(5)->get();

        // Ambil data penjualan per bulan
        $rawSalesData = Transaction::selectRaw('SUM(total_amount) as total, MONTH(created_at) as month')
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->pluck('total', 'month')
            ->toArray();

        // Gabungkan dengan bulan kosong & ubah ke indexed array untuk Chart.js
        $mergedData = array_replace(array_fill(1, 12, 0), $rawSalesData);
        $salesDataFixed = [];

        for ($i = 1; $i <= 12; $i++) {
            $salesDataFixed[] = $mergedData[$i];
        }

        // Buat array bulan 1–12
        $months = range(1, 12);

        // Kirim ke view
        return view('halaman.adminHome', [
            'totalMenu' => $totalMenu,
            'totalTransactions' => $totalTransactions,
            'totalAdmins' => $totalAdmins,
            'recentActivities' => $recentActivities,
            'salesData' => $salesDataFixed,
            'months' => $months,
        ]);

    } else {
        // Redirect jika bukan admin
        return redirect()->route('home')->with('error', 'Akses ditolak!');
    }
}
}