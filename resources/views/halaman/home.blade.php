@extends('mainlayout')

@section('content')

<!-- Tambahkan Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container-fluid text-center p-0">
    <h1 class="text-3xl font-bold mt-4">Selamat Datang di Floristeria</h1>
    <p class="text-lg text-gray-600">Temukan rangkaian bunga terbaik untuk setiap momen spesial Anda.</p>

    <!-- SLIDER IMAGE & VIDEO Full Width -->
    <div id="bouquetCarousel" class="carousel slide mt-4" data-bs-ride="carousel">
        <div class="carousel-inner">
            <!-- Slide Video (Pertama) -->
            <div class="carousel-item active" data-bs-interval="false">
                <video class="d-block w-100" id="videoSlide" autoplay muted playsinline>
                    <source src="{{ asset('images/vid1.mp4') }}" type="video/mp4">
                    Browser Anda tidak mendukung tag video.
                </video>
            </div>

            <!-- Slide Gambar 1 -->
            <div class="carousel-item" data-bs-interval="3000">
                <img src="{{ asset('images/1.jpg') }}" class="d-block w-100" alt="Buket 1">
            </div>

            <!-- Slide Gambar 2 -->
            <div class="carousel-item" data-bs-interval="3000">
                <img src="{{ asset('images/3.jpg') }}" class="d-block w-100" alt="Buket 2">
            </div>
        </div>

        <!-- Tombol Navigasi -->
        <button class="carousel-control-prev" type="button" data-bs-target="#bouquetCarousel" data-bs-slide="prev" style="width: 5%;">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#bouquetCarousel" data-bs-slide="next" style="width: 5%;">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
    </div>

    <!-- TOMBOL PESAN SEKARANG -->
    <div class="mt-4">
        <a href="{{ route('menu.filter') }}" class="btn btn-primary btn-lg">Pesan Sekarang</a>
    </div>
</div>

<!-- Tambahkan Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var myCarousel = new bootstrap.Carousel(document.getElementById('bouquetCarousel'), {
            interval: 3000, // Gambar berganti otomatis setiap 3 detik
            ride: 'carousel' // Aktifkan auto-slide
        });

        var video = document.getElementById("videoSlide");

        // Hentikan auto-slide saat video sedang berjalan
        video.addEventListener("playing", function () {
            myCarousel.pause();
        });

        // Lanjutkan carousel setelah video selesai
        video.addEventListener("ended", function () {
            myCarousel.cycle(); // Mulai auto-slide lagi
            myCarousel.next();  // Pindah ke slide berikutnya
        });

        // Restart video saat slide kembali ke video
        document.getElementById('bouquetCarousel').addEventListener('slid.bs.carousel', function (event) {
            if (event.to === 0) { // Jika kembali ke slide pertama (video)
                video.currentTime = 0; // Set waktu ulang ke 0
                video.play(); // Mulai ulang video
                myCarousel.pause(); // Hentikan auto-slide selama video berjalan
            }
        });
    });
</script>

@endsection
