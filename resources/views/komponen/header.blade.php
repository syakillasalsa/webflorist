<header>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Floristeria</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<header class="text-center mt-3">
    <img src="{{ asset('images/6.jpg') }}" alt="Posie Florist Logo" width="300" class="d-block mx-auto">

    <nav class="ellipse-nav">
        <ul class="nav nav-pills justify-content-center">
            <li class="nav-item"><a class="nav-link text-dark" href="/">Home</a></li>
            <li class="nav-item"><a class="nav-link text-dark" href="/menu">Order</a></li>
            <li class="nav-item"><a class="nav-link text-dark" href="/about">About Us</a></li>
            
            @if(Auth::check())
                <!-- Jika Sudah Login, tampilkan Logout -->
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            @else
                <!-- Jika Belum Login -->
                <li class="nav-item"><a class="nav-link text-dark" href="/login">Login</a></li>
            @endif
        </ul>
    </nav>
</header>
