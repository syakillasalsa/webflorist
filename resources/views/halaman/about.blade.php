@extends('mainlayout')

@section('content')

<!-- Tambahkan Bootstrap CSS jika belum -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Tambahkan CSS eksternal -->
<link href="{{ asset('css/about.css') }}" rel="stylesheet">

<!-- SECTION ABOUT US -->
<div class="container py-0 mt-5">
    <div class="row align-items-center">
        <!-- Kolom gambar di sebelah kiri -->
        <div class="col-md-6 text-center mb-4 mb-md-0">
            <img src="{{ asset('images/about.png') }}" alt="Bouquet Image" class="about-image">
        </div>

        <!-- Kolom teks di sebelah kanan -->
        <div class="col-md-6">
            <h3 class="about-title">BLOSSOM HOUSE</h3>
            <p class="about-text">
                <strong>Blossom House</strong> is a flower house located in Central Jakarta, Blok M. We've been serving you since 2018 and it feels amazing to be a "Messenger" to our beloved customers for the past years. Professionally curated by a local expert, Floristeria offers more than hundreds of bouquet, flower box, flower basket, and gift options to choose from.
            </p>
            <p class="about-text">
                Blossom House is now available in Solo. Let’s create your happy moments with us!
            </p>
            <div class="about-video mt-4">
            <video class="w-100 rounded" autoplay muted loop playsinline>
            <source src="{{ asset('images/about.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
            </video>
            </div>

            
        </div>
    </div>
</div>

<!-- WHY CHOOSE US SECTION -->
<div class="container my-4 why-choose-section">
    <h2 class="text-center mb-4 fw-bold">WHY CHOOSE US?</h2>
    <div class="row justify-content-center">
        <!-- Box 1 -->
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="p-4 bg-white rounded shadow-sm text-center h-100">
                <img src="{{ asset('images/store.png') }}" alt="Branch Icon" class="mb-3" style="width: 40px;">
                <h5 class="fw-bold">Best Shops in Town</h5>
                <p class="text-muted mb-0">Has a 5-star rating and has been around since 2018</p>
            </div>
        </div>
        <!-- Box 2 -->
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="p-4 bg-white rounded shadow-sm text-center h-100">
                <img src="{{ asset('images/shipped.png') }}" alt="Shipping Icon" class="mb-3" style="width: 40px;">
                <h5 class="fw-bold">Fast shipping</h5>
                <p class="text-muted mb-0">Our couriers will deliver the bouquet within an hour</p>
            </div>
        </div>
        <!-- Box 3 -->
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="p-4 bg-white rounded shadow-sm text-center h-100">
                <img src="{{ asset('images/bouquet.png') }}" alt="Photo Icon" class="mb-3" style="width: 40px;">
                <h5 class="fw-bold">Photo of flowers</h5>
                <p class="text-muted mb-0">We will show you exactly what your bouquet looks like before delivery</p>
            </div>
        </div>
    </div>
</div>

<!-- MINI REVIEWS (2 KOLUMN, 6 REVIEW) -->
<div class="container my-4">
    <h4 class="fw-bold text-center mb-4">What Our Customers Say</h4>

    <div class="row">
        <!-- Kolom Kiri -->
        <div class="col-md-6 d-flex flex-column gap-3 mb-3">
            <!-- Review 1 -->
            <div class="d-flex align-items-start review-mini">
                <img src="{{ asset('images/kendall.jpg') }}" alt="User" class="rounded-circle me-3" width="45" height="45">
                <div>
                    <div class="fw-semibold">Kendall Jenner</div>
                    <div class="text-warning small">★★★★★</div>
                    <div class="text-muted small fst-italic">
                        "Absolutely loved the flowers. Delivered just in time!"
                    </div>
                </div>
            </div>

            <!-- Review 2 -->
            <div class="d-flex align-items-start review-mini">
                <img src="{{ asset('images/jh.jpg') }}" alt="User" class="rounded-circle me-3" width="45" height="45">
                <div>
                    <div class="fw-semibold">Jung Jaehyun</div>
                    <div class="text-warning small">★★★★★</div>
                    <div class="text-muted small fst-italic">
                        "Perfect for anniversaries. She was really happy!"
                    </div>
                </div>
            </div>

            <!-- Review 3 -->
            <div class="d-flex align-items-start review-mini">
                <img src="{{ asset('images/gracie.jpg') }}" alt="User" class="rounded-circle me-3" width="45" height="45">
                <div>
                    <div class="fw-semibold">Gracie Abrams</div>
                    <div class="text-warning small">★★★★★</div>
                    <div class="text-muted small fst-italic">
                        "Amazing service. Will definitely order again!"
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan -->
        <div class="col-md-6 d-flex flex-column gap-3">
            <!-- Review 4 -->
            <div class="d-flex align-items-start review-mini">
                <img src="{{ asset('images/lisa.jpg') }}" alt="User" class="rounded-circle me-3" width="45" height="45">
                <div>
                    <div class="fw-semibold">Lalisa Manoban</div>
                    <div class="text-warning small">★★★★★</div>
                    <div class="text-muted small fst-italic">
                        "They never fail to impress me. Bouquets are always fresh!"
                    </div>
                </div>
            </div>

            <!-- Review 5 -->
            <div class="d-flex align-items-start review-mini">
                <img src="{{ asset('images/shawn.jpg') }}" alt="User" class="rounded-circle me-3" width="45" height="45">
                <div>
                    <div class="fw-semibold">Shawn Mendes</div>
                    <div class="text-warning small">★★★★★</div>
                    <div class="text-muted small fst-italic">
                        "Used them for my sister's wedding. Everything was perfect!"
                    </div>
                </div>
            </div>

            <!-- Review 6 -->
            <div class="d-flex align-items-start review-mini">
                <img src="{{ asset('images/rose.jpg') }}" alt="User" class="rounded-circle me-3" width="45" height="45">
                <div>
                    <div class="fw-semibold">Roseanne Park</div>
                    <div class="text-warning small">★★★★★</div>
                    <div class="text-muted small fst-italic">
                        "Customer service was super helpful and kind.THANK YOU!!"
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Clearfix agar footer tidak terdorong -->
<div class="clearfix"></div>

@endsection
