@extends('mainlayout')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<div class="container py-5">
    <h2 class="text-center mb-4"><em>Checkout</em></h2>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(count($cart) > 0)
    <div class="row">
    <!-- Kolom Kiri - Daftar Barang & Total -->
    <div class="col-md-5 order-md-1">
        @foreach($cart as $id => $item)
        <div class="border-bottom py-3 d-flex align-items-center">
            <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" width="80" class="me-3">
            <div class="flex-grow-1">
                <h5>{{ $item['name'] }}</h5>
                <p class="text-muted">Rp{{ number_format($item['price'], 0, ',', '.') }}</p>
                <div class="d-inline-flex align-items-center">
                    <a href="{{ route('cart.decrease', $id) }}" class="btn btn-outline-secondary btn-sm">−</a>
                    <input type="text" class="form-control text-center mx-1" value="{{ $item['quantity'] }}" style="width: 50px;" readonly>
                    <a href="{{ route('cart.increase', $id) }}" class="btn btn-outline-secondary btn-sm">+</a>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <p class="mb-0 me-3"><strong>Rp{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</strong></p>
                <a href="{{ route('cart.remove', $id) }}">
                    <i class="fas fa-trash-alt" style="color: gray; font-size: 18px;"></i>
                </a>
            </div>
        </div>
        @endforeach
        <h5 class="mt-3">Total: <strong>Rp{{ number_format($subtotal, 0, ',', '.') }}</strong></h5>

        <!-- Tombol Kembali ke Menu -->
        <div class="text-center mt-3">
            <a href="{{ route('menu.filter') }}" class="btn btn-secondary">Kembali ke Menu</a>
        </div>
    </div>

    <!-- Kolom Tengah - Catatan -->
    <div class="col-md-2 order-md-2 text-center">
        <h5>Catatan</h5>
        <textarea id="note" class="form-control small-textarea">{{ old('note', session('checkout_data.note')) }}</textarea>
    </div>

    <!-- Kolom Kanan - Metode Pengiriman -->
    <div class="col-md-5 order-md-3">
        <h5><em>Metode Pengiriman</em></h5>
        <hr>
        <form id="checkoutForm" action="{{ route('checkout.process') }}" method="POST">
            @csrf
            <input type="hidden" name="total" value="{{ $subtotal }}">
            <input type="hidden" name="note" id="hiddenNote">

            <div class="mb-3">
                <label>Metode Pengiriman:</label>
                <select id="shippingMethod" name="shipping_method" class="form-control" required>
                    <option value="pickup" {{ old('shipping_method') == 'pickup' ? 'selected' : '' }}>Ambil di Toko</option>
                    <option value="delivery" {{ old('shipping_method') == 'delivery' ? 'selected' : '' }}>Antar ke Alamat</option>
                </select>
            </div>

            <div id="addressField" class="mb-3" style="display: none;">
                <label>Alamat Pengiriman:</label>
                <textarea name="address" class="form-control"></textarea>
            </div>

            <div id="storeAddress" class="mb-3" style="display: none;">
                <label>Alamat Toko:</label>
                <p class="border p-2">Jl. Contoh No.123, Kota XYZ</p>
            </div>

            <button type="submit" class="btn btn-primary w-100">Lanjut ke Pembayaran</button>
        </form>
    </div>
</div>


    @else
        <p class="text-center">Keranjang Anda kosong.</p>
        <div class="text-center">
            <a href="{{ route('menu.filter') }}" class="btn btn-primary">Lihat Menu</a>
        </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var shippingMethod = document.getElementById('shippingMethod');
    var addressField = document.getElementById('addressField');
    var storeAddress = document.getElementById('storeAddress');
    var noteTextarea = document.getElementById('note');
    var hiddenNoteInput = document.getElementById('hiddenNote');
    var checkoutForm = document.getElementById('checkoutForm');

    function updateAddressField() {
        if (shippingMethod.value === 'delivery') {
            addressField.style.display = 'block';
            storeAddress.style.display = 'none';
        } else {
            addressField.style.display = 'none';
            storeAddress.style.display = 'block';
        }
    }

    // Menyimpan nilai catatan sebelum submit
    checkoutForm.addEventListener('submit', function() {
        hiddenNoteInput.value = noteTextarea.value;
    });

    shippingMethod.addEventListener('change', updateAddressField);
    updateAddressField(); // Panggil saat halaman dimuat untuk set default
});
</script>
@endsection 