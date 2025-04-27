@extends('mainlayout')

@section('content')

<!-- Tambahkan Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- SECTION ABOUT US -->
<div class="container py-5 mt-5">
    <h2 class="text-center text-uppercase fw-bold mb-4">About Us</h2>
    <div class="row align-items-center">
        <div class="col-md-6 mb-4 mb-md-0">
            <div class="position-relative d-flex justify-content-center align-items-center rounded-circle mx-auto" style="width: 400px; height: 400px; background-color: #ead1d1;">
                <img src="{{ asset('images/flower1.png') }}" class="position-absolute" style="left: 0; bottom: 0; width: 130px;" alt="Pink Tulips">
                <img src="{{ asset('images/flower2.png') }}" class="position-absolute" style="width: 180px;" alt="Red Roses">
                <img src="{{ asset('images/flower3.png') }}" class="position-absolute" style="right: 0; bottom: 0; width: 130px;" alt="Peach Roses">
            </div>
        </div>
        <div class="col-md-6">
            <h3 class="fw-bold text-uppercase">PEONY & CO</h3>
            <p><strong>PEONY & CO</strong> is a flower house located in Central Jakarta, Blok M. We've been serving you since 2018 and it feels amazing to be a "Messenger" to our beloved customers for the past years. Professionally curated by a local expert, Floristeria offers more than hundreds of bouquet, flower box, flower basket, and gift options to choose from.</p>
            <p>Whatever the occasion—season’s greeting, anniversary, graduation wishes, birthday, Valentine's, wedding, engagement, newborn, Christmas, Eid Mubarak, and many more—Peony&Co is here to bring beauty into your life.</p>
            <p>Peony&Co is now available in Solo. Let’s create your happy moments with us!</p>
        </div>
    </div>
</div>

<!-- Clearfix agar footer tidak terdorong -->
<div class="clearfix"></div>

@endsection