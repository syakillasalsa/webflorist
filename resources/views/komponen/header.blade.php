<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Floristeria</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        /* Styling untuk memastikan ikon dan nama pengguna di pojok kanan atas tanpa mengikuti scroll */
        .user-info {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
            z-index: 9999; /* Agar selalu di atas elemen lain */
        }

        .user-info img {
            width: 30px;
            height: 30px;
            cursor: pointer; /* Menunjukkan bahwa ini dapat diklik */
        }

        .user-info span {
            cursor: pointer; /* Menunjukkan bahwa nama bisa diklik */
        }

        /* Styling dropdown menu */
        .dropdown-menu {
            display: none;
            position: absolute;
            top: 40px; /* Jarak antara ikon dan dropdown */
            right: 0;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 200px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
            transform: translateY(-10px); /* Start hidden above */
            opacity: 0; /* Start hidden */
        }

        .dropdown-menu.show {
            display: block;
            opacity: 1;
            transform: translateY(0); /* Move into view */
        }

        .dropdown-menu a {
            padding: 10px;
            display: flex;
            align-items: center;
            color: #333;
            text-decoration: none;
            border-bottom: 1px solid #ddd;
            transition: background-color 0.3s ease;
        }

        .dropdown-menu a:hover {
            background-color: #f8f9fa;
        }

        .dropdown-menu a:last-child {
            border-bottom: none;
        }

        /* Styling untuk menambahkan ikon logout */
        .dropdown-menu a .logout-icon {
            margin-right: 10px; /* Memberikan jarak antara ikon dan teks */
            font-size: 18px; /* Ukuran ikon */
        }
    </style>
</head>
<body>

    <!-- Logo -->
    <div class="text-center mt-4">
        <img src="{{ asset('images/h11.png') }}" alt="Posie Florist Logo" width="500">
    </div>

    <!-- Navbar Tengah (tanpa logout) -->
    <nav class="ellipse-nav mt-3">
        <ul class="nav nav-pills justify-content-center">
            <li class="nav-item mx-4"><a class="nav-link text-dark" href="/">HOME</a></li>
            <li class="nav-item mx-4"><a class="nav-link text-dark" href="/menu">ORDER</a></li>
            <li class="nav-item mx-4"><a class="nav-link text-dark" href="/about">ABOUT US</a></li>
        </ul>
    </nav>

    <!-- User Info di pojok kanan atas -->
    @if(Auth::check())
        <div class="user-info">
            <img src="{{ asset('images/people.jpg') }}" alt="User Icon" id="user-icon">
            <span>Halo, {{ Auth::user()->name }}</span>
        </div>

        <!-- Dropdown Menu -->
        <div id="dropdown-menu" class="dropdown-menu">
            <a href="#" id="logout-link">
                <i class="fas fa-sign-out-alt logout-icon"></i> Logout
            </a>
            <!-- Form Logout -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
        @else
    <div class="user-info">
        <a href="/login" class="d-flex align-items-center text-decoration-none text-dark">
            <img src="{{ asset('images/people.jpg') }}" alt="Login Icon" id="login-icon">
            <span class="ms-2">Login</span>
        </a>
    </div>
@endif


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const userIcon = document.querySelector('#user-icon');
            const loginIcon = document.querySelector('#login-icon');
            const dropdownMenu = document.querySelector('#dropdown-menu');
            const logoutLink = document.querySelector('#logout-link');

            // Toggle dropdown menu on user icon click
            if (userIcon) {
                userIcon.addEventListener('click', function () {
                    dropdownMenu.classList.toggle('show');
                });
            }

            // Handle logout action
            logoutLink.addEventListener('click', function (event) {
                event.preventDefault(); // Prevent default link behavior (for smooth logout process)

                // Trigger form submission for logout
                document.getElementById('logout-form').submit();
                
                // After logout, redirect to home page
                setTimeout(function() {
                    window.location.href = '/';
                }, 1000); // Timeout to wait for logout to process
            });

            // Change to login icon if not logged in
            if (!userIcon) {
                loginIcon.addEventListener('click', function () {
                    window.location.href = '/login';
                });
            }

            // Close dropdown menu if clicked outside
            document.addEventListener('click', function (event) {
                if (!userIcon.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.remove('show');
                }
            });
        });
    </script>

</body>
</html>