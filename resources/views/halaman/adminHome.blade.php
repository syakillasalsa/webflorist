@extends('mainlayout')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12 text-center">
            <h1>Selamat datang di Dashboard Admin</h1>
            <p>Kelola menu, transaksi, dan admin melalui dashboard ini.</p>
        </div>
    </div>

    <div class="row mt-4">
        <!-- Statistik Menu -->
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-4">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Menu</h5>
                    <p class="card-text">{{ $totalMenu }}</p>
                </div>
            </div>
        </div>

        <!-- Statistik Transaksi -->
        <div class="col-md-4">
            <div class="card text-white bg-success mb-4">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Transaksi</h5>
                    <p class="card-text">{{ $totalTransactions }}</p>
                </div>
            </div>
        </div>

        <!-- Statistik Admin -->
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-4">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Admin</h5>
                    <p class="card-text">{{ $totalAdmins }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mt-4">
        <div class="col-md-4">
            <a href="{{ route('menu.filter') }}" class="btn btn-primary btn-lg btn-block">Kelola Menu</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('admin.transactions') }}" class="btn btn-success btn-lg btn-block">Lihat Transaksi</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('admin.transactions') }}" class="btn btn-warning btn-lg btn-block">Kelola Admin</a>
        </div>
    </div>

    <!-- Aktivitas Terbaru -->
    <div class="row mt-5">
        <div class="col-12">
            <h4>Aktivitas Terbaru</h4>
            
            @if($recentActivities->isEmpty())
                <p>Tidak ada aktivitas terbaru.</p>
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Aktivitas</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recentActivities as $activity)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $activity->description }}</td> <!-- Ganti dengan kolom yang sesuai di Transaction -->
                            <td>{{ $activity->created_at->format('d-m-Y H:i') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <!-- Grafik Statistik (Opsional) -->
    <div class="row mt-5">
        <div class="col-12">
            <h4>Grafik Statistik Menu</h4>
            <div id="menuChart"></div>
        </div>
    </div>
</div>
@endsection
