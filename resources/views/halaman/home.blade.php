@extends('mainlayout')

@section('content')

<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Alumni+Sans:ital,wght@0,100..900;1,100..900&family=Athiti:wght@200;300;400;500;600;700&family=Bodoni+Moda:ital,opsz,wght@0,6..96,400..900;1,6..96,400..900&family=Cormorant+Garamond:ital,wght@0,300..700;1,300..700&family=EB+Garamond:ital,wght@0,400..800;1,400..800&family=Satisfy&display=swap" rel="stylesheet">

<!-- Tambahkan Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-pA+tkDk/1Uc9V2tCqZEqK6hZuZ7Fx3V4Zm02E7pybKwH0y8pyh4OZIoOy3K3xW9cz5UZqhfQg/PI59+RZgyT4g==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<!-- SLIDER VIDEO -->
<div class="container-fluid text-center p-0">
    <div id="bouquetCarousel" class="carousel slide mt-0" data-bs-ride="carousel" data-bs-interval="false">
        <div class="carousel-inner">
            <!-- Slide 1 -->
            <div class="carousel-item active">
                <video class="d-block w-100 rounded-lg" id="video1" muted playsinline>
                    <source src="{{ asset('images/slidebar1.mp4') }}" type="video/mp4">
                    Browser Anda tidak mendukung video.
                </video>
            </div>
            <!-- Slide 2 -->
            <div class="carousel-item">
                <video class="d-block w-100 rounded-lg" id="video2" muted playsinline>
                    <source src="{{ asset('images/slidebar2.mp4') }}" type="video/mp4">
                    Browser Anda tidak mendukung video.
                </video>
            </div>
        </div>
            
        
        <!-- Tombol Navigasi -->
        <button class="carousel-control-prev" type="button" data-bs-target="#bouquetCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#bouquetCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
    </div>
</div>

<!-- SECTION KATALOG 1 -->
<div class="container py-5 mb-5">
    <h2 class="text-center text-uppercase fw-bold mb-4">NEW</h2>
    <div class="row">
        @foreach ([
            ['b1.webp', 'Sweet Hermosa Bouquet', 'RP 1.200.000'],
            ['b2.webp', 'Sweet Mahogany', 'RP 2.200.000'],
            ['b3.webp', 'Passion In Bloom', 'RP 1.950.000'],
            ['b4.webp', 'Heartfelt Harmony Blossom', 'RP 2.100.000']
        ] as $product)
        <div class="col-md-3">
            <div class="card shadow-sm">
                <img src="{{ asset('images/' . $product[0]) }}" class="card-img-top" alt="{{ $product[1] }}">
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $product[1] }}</h5>
                    <p class="text-muted">{{ $product[2] }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- SECTION KATALOG 2 -->
<div class="container py-3 mb-5">
    <h2 class="text-center text-uppercase fw-bold mb-4">EVERLASTING AND DRIED FLOWERS</h2>
    <div class="row">
        @foreach ([
            ['b5.webp', 'Pretty Sola Flower', 'RP 2.900.000'],
            ['b6.webp', 'Autumn Flower', 'RP 1.200.000'],
            ['b7.webp', 'Purple Flower', 'RP 1.950.000'],
            ['b8.webp', 'My Sunshine Flower', 'RP 2.500.000']
        ] as $product)
        <div class="col-md-3">
            <div class="card shadow-sm">
                <img src="{{ asset('images/' . $product[0]) }}" class="card-img-top" alt="{{ $product[1] }}">
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $product[1] }}</h5>
                    <p class="text-muted">{{ $product[2] }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <!-- TOMBOL PESAN SEKARANG -->
<div class="mt-4 text-center">
    <a href="{{ route('menu.filter') }}" class="btn-order">View All Products</a>
</div>
</div>

<div class="container py-4">
    <div class="row align-items-center g-5">
        <div class="col-md-7">
            <h2 class="title-home">BLOSSOM HOUSE</h2>
            <p class="justify-text"><strong>Blossom House</strong> is a flower house located in Central Jakarta, Blok M. We've been serving you since 2018 and it feels amazing to be a "Messenger" to our beloved customers for the past years. Professionally curated by a local expert, Floristeria offers more than hundreds of bouquet, flower box, flower basket, and gift options to choose from. Whatever the occasion—season’s greeting, anniversary, graduation wishes, birthday, Valentine's, wedding, engagement, newborn, Christmas, Eid Mubarak, and many Blossom House is here to bring beauty into your life. </p>

            <p class="justify-text"> It is perhaps the most used and successful form of communicating your feelings to those you care about. At Floristeria, we realize the worth of your emotions, which is what makes us the number one choice for sending out your love to dear ones—be it a happy occasion or a sad one. Blossom House is just a click away.</p>
            <p class="justify-text">Flowers are nature’s most delicate expression of beauty and emotion. Each bloom carries a whisper of love, a touch of hope, and a sense of peace. Through every petal, we find a language that speaks directly to the heart. </p>
            <p class="justify-text">A good life is a collection of happy moments. Let’s create your happy moments with us—not just through flowers, but through the love, warmth, and sincerity that each arrangement carries. At Blossom House, we believe that every bloom holds a story, every bouquet brings a smile, and every gift becomes a memory. Whether it's a celebration of love, a gesture of comfort, or a simple reminder that someone cares, we're here to help you express what words sometimes cannot. Because happiness is best shared, and memories are best made—beautifully, thoughtfully, and together..</p>

            <p class="justify-text">2025 is an amazing year for us because we are beyond excited to announce that Blossom House is now available in Solo. As we all know, Solo is a city rich in culture, tradition, and timeless charm—a place where warmth and kindness are part of everyday life. It’s a city that holds countless memories, celebrations, and heartfelt moments, and we are honored to now be a part of those special occasions.

This expansion is more than just opening a new branch—it’s about bringing our passion, love, and craftsmanship to more people, more hearts, and more stories. We believe that every smile in Solo deserves to be celebrated with a beautiful bouquet, every success deserves a sweet surprise, and every feeling deserves to be expressed with grace and elegance.

Whether you’re planning a romantic surprise, sending a birthday wish, congratulating someone you love, or simply letting someone know they’re on your mind, you no longer have to worry. Blossom House is here, closer than ever, to deliver stunning floral arrangements that speak from the heart—crafted with care, delivered with love, and made to make your moments truly unforgettable.</p>
        </div>

        <div class="col-md-5">
            <div class="img-wrapper">
                <img src="{{ asset('images/d1.jpg') }}" alt="Florist" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>
</div>


<div class="clearfix"></div>


<!-- SCRIPT VIDEO CAROUSEL -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const carousel = document.getElementById('bouquetCarousel');
        const bsCarousel = new bootstrap.Carousel(carousel, {
            interval: false,
            ride: false
        });

        const videos = carousel.querySelectorAll('video');

        function playActiveVideo() {
            videos.forEach(video => {
                video.pause();
                video.currentTime = 0;
            });
            const activeVideo = carousel.querySelector('.carousel-item.active video');
            if (activeVideo) {
                activeVideo.play();
            }
        }

        // Play video pertama saat load
        playActiveVideo();

        // Pindah slide otomatis setelah video selesai
        videos.forEach(video => {
            video.addEventListener('ended', () => {
                bsCarousel.next();
            });
        });

        // Saat slide berubah, play ulang video baru
        carousel.addEventListener('slid.bs.carousel', () => {
            playActiveVideo();
        });
    });
</script>

@endsection
