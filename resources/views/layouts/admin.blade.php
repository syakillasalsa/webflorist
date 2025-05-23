<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin</title>

    <!-- Bootstrap dan ikon dulu -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- CSS kamu paling akhir supaya override semua -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

<!-- Navbar -->
<!-- Navbar Admin -->
<nav class="navbar navbar-expand-lg navbar-custom navbar-dark">

        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.home') }}">Admin Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.transactions') }}">Transactions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('order.index') }}">Add Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

<!-- Konten -->
<div class="container my-5">
    @yield('content')
</div>

<!-- Footer -->
<footer class="footer text-center py-4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <a href="/about" class="footer-link">ABOUT US</a>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <a href="#" class="social-icon"><i class="fab fa-facebook"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <p>We Accept</p>
                <img src="{{ asset('images/bca.png') }}" alt="BCA" class="payment-icon">
                <img src="{{ asset('images/qris.png') }}" alt="Qris" class="payment-icon">
                <img src="{{ asset('images/visa.png') }}" alt="Visa" class="payment-icon">
                <img src="{{ asset('images/mastercard.png') }}" alt="MasterCard" class="payment-icon">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <p class="copyright">©BlossomHouse</p>
            </div>
        </div>
    </div>
</footer>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>

@stack('scripts')
</body>
</html>
