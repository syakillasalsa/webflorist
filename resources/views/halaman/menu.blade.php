@extends('mainlayout')

@section('content')
<div class="container py-4">
    <h2 class="text-center mb-4">PRODUCTS</h2>

    <div class="menu-wrapper d-flex">
        <!-- Sidebar Filter -->
        <div class="filter-sidebar me-4">
            <h5 class="fw-bold">Filter by</h5>
            <p class="fw-bold">Category</p>
            <ul class="filter-list list-unstyled">
                <li><a href="{{ route('menu.filter') }}" class="{{ request()->category ? '' : 'active' }}">All</a></li>
                <li><a href="{{ route('menu.filter', ['category' => 'Bunga']) }}" class="{{ request()->category == 'Bunga' ? 'active' : '' }}">Flower</a></li>
                <li><a href="{{ route('menu.filter', ['category' => 'Buket']) }}" class="{{ request()->category == 'Buket' ? 'active' : '' }}">Bouquet</a></li>
                <li><a href="{{ route('menu.filter', ['category' => 'Kertas']) }}" class="{{ request()->category == 'Kertas' ? 'active' : '' }}">Paper</a></li>
            </ul>
        </div>

        <!-- Produk List -->
        <div class="menu-container flex-grow-1">
            <div class="row" id="product-list">
                @foreach($bouquets as $menu)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <img src="{{ asset('storage/' . $menu->image) }}" class="card-img-top menu-img" alt="{{ $menu->name }}">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $menu->name }}</h5>
                                <p class="card-text text-muted">{{ $menu->description }}</p>
                                <p class="fw-bold">Rp{{ number_format($menu->price, 0, ',', '.') }}</p>
                                <form action="{{ route('checkout.addToCart', $menu->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-bouquet">Order Now</button>
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

@push('scripts')
<script>
    function loadProducts() {
        const category = "{{ request()->category }}";
        fetch(`/menu/fetch?category=${category}`)
            .then(res => res.json())
            .then(data => {
                document.getElementById('product-list').innerHTML = data.html;
            });
    }

    // Jalankan setiap 5 menit (300.000 ms)
    setInterval(loadProducts, 300000);
</script>
@endpush
