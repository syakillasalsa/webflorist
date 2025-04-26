@extends('mainlayout')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">Daftar Menu Bunga</h2>

    <div class="menu-wrapper">
        <!-- Sidebar Filter -->
        <div class="filter-sidebar">
            <h5 class="fw-bold">Filter by</h5>
            <p class="fw-bold">Category</p>
            <ul class="filter-list">
                <li><a href="{{ route('menu.filter') }}" class="{{ request()->category ? '' : 'active' }}">All</a></li>
                <li><a href="{{ route('menu.filter', ['category' => 'Bunga']) }}" class="{{ request()->category == 'Bunga' ? 'active' : '' }}">Bunga</a></li>
                <li><a href="{{ route('menu.filter', ['category' => 'Buket']) }}" class="{{ request()->category == 'Buket' ? 'active' : '' }}">Buket</a></li>
                <li><a href="{{ route('menu.filter', ['category' => 'Kertas']) }}" class="{{ request()->category == 'Kertas' ? 'active' : '' }}">Kertas</a></li>
            </ul>
        </div>

        <!-- Produk List -->
        <div class="menu-container">
            <div class="row">
                @foreach($bouquets as $menu)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <img src="{{ asset('storage/' . $menu->image) }}" class="card-img-top menu-img" alt="{{ $menu->name }}">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $menu->name }}</h5>
                                <p class="card-text text-muted">{{ $menu->description }}</p>
                                <p class="fw-bold">Rp{{ number_format($menu->price, 0, ',', '.') }}</p>
                                
                                <!-- Form untuk tambah ke keranjang -->
                                <form action="{{ route('checkout.addToCart', $menu->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Pesan Sekarang</button>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
