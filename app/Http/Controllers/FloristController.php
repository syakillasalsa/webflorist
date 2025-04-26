<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bouquet;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;  // <-- Import Auth di sini


class FloristController extends Controller
{
    // Menampilkan halaman home
    public function index()
    {
        $bouquets = Bouquet::all();
        return view('halaman.home', compact('bouquets'));
    }

    // Menampilkan halaman order
    public function showOrders()
    {
        $bouquets = Bouquet::all();
        return view('halaman.order', compact('bouquets'));
    }

    public function about()
{
    return view('halaman.about'); // Ganti dengan nama folder & file blade kamu
}
    // Menampilkan halaman tambah buket
    public function create()
    {
        return view('halaman.tambah');
    }

    // Menyimpan buket bunga baru
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric',
            'category'    => 'required|in:Bunga,Buket,Kertas', 
            'image'       => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Simpan gambar
        $imagePath = $request->file('image')->store('bouquet_images', 'public');

        // Simpan ke database
        Bouquet::create([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'category'    => $request->category,
            'image'       => $imagePath
        ]);

        return redirect()->route('order.index')->with('success', 'Buket bunga berhasil ditambahkan!');
    }

    // Menampilkan halaman edit buket
    public function edit($id)
    {
        $bouquet = Bouquet::findOrFail($id);
        return view('halaman.edit', compact('bouquet'));
    }

    // Memperbarui buket bunga
    public function update(Request $request, $id)
    {
        $bouquet = Bouquet::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric',
            'category'    => 'required|in:Bunga,Buket,Kertas', // ✅ Pastikan kategori tetap ada
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $bouquet->name        = $request->name;
        $bouquet->description = $request->description;
        $bouquet->price       = $request->price;
        $bouquet->category    = $request->category; // ✅ Perbarui kategori

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

    // Menghapus buket bunga
    public function destroy($id)
    {
        $bouquet = Bouquet::findOrFail($id);

        if ($bouquet->image) {
            Storage::delete('public/' . $bouquet->image);
        }

        $bouquet->delete();

        return redirect()->route('order.index')->with('success', 'Buket bunga berhasil dihapus!');
    }

    // Menampilkan halaman menu berdasarkan kategori
    // Menampilkan halaman menu berdasarkan kategori
public function menu(Request $request)
{
    // Ambil kategori yang dipilih dari request
    $category = $request->get('category');

    // Jika kategori dipilih, filter berdasarkan kategori tersebut
    if ($category) {
        $bouquets = Bouquet::where('category', $category)->get();
    } else {
        // Jika tidak ada kategori, tampilkan semua produk
        $bouquets = Bouquet::all();
    }

    return view('halaman.menu', compact('bouquets'));
}


    // Memperbarui kategori buket bunga
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



    // ✅ Menghapus item dari keranjang
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
            unset($cart[$id]); // Hapus item jika jumlahnya 1
        }
        session()->put('cart', $cart);
    }
    return redirect()->back();
}
public function checkout()
{
    $cart = session()->get('cart', []);
    $subtotal = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

    // Ambil catatan yang sudah disimpan di session
    $cartNote = session()->get('cart_note', '');

    return view('halaman.checkout', compact('cart', 'subtotal', 'cartNote'));
}


public function processPayment(Request $request)
{
    // Validasi data input
    $request->validate([
        'payment_method' => 'required',
        'address' => 'required'
    ]);

    // Simulasi proses pembayaran (bisa disimpan ke database di sini)
    session()->forget('cart'); // Kosongkan keranjang setelah pembayaran

    return redirect()->route('order.success')->with('success', 'Pembayaran berhasil! Pesanan sedang diproses.');
}
public function saveNote(Request $request)
    {
        // Simpan catatan ke sesi
        Session::put('cart_note', $request->note);

        return redirect()->route('cart')->with('success', 'Catatan berhasil disimpan.');
    }
    public function home()
    {
        $totalMenu = \DB::table('bouquets')->count(); // Ganti dari 'menu' ke 'bouquets'
        $totalTransactions = \DB::table('transactions')->count();
        $totalAdmins = \DB::table('users')->where('role', 'admin')->count();
    
        return view('halaman.adminHome', compact('totalMenu', 'totalTransactions', 'totalAdmins'));
    }
        public function showDashboard()
        {
            // Ambil transaksi terbaru (misalnya 5 transaksi terakhir)
            $recentActivities = Transaction::latest()->take(5)->get(); // Mengambil 5 transaksi terbaru
    
            // Ambil data statistik lainnya
            $totalMenu = Menu::count(); // Menghitung jumlah menu
            $totalTransactions = Transaction::count(); // Menghitung jumlah transaksi
            $totalAdmins = User::where('role', 'admin')->count(); // Menghitung jumlah admin
    
            // Kembalikan tampilan dengan data yang diperlukan
            return view('halaman.adminHome', compact('recentActivities', 'totalMenu', 'totalTransactions', 'totalAdmins'));
        }
    }
    

