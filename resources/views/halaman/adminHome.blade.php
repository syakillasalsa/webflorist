@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Alumni+Sans:ital,wght@0,100..900;1,100..900&family=Athiti:wght@200;300;400;500;600;700&family=Bodoni+Moda:ital,opsz,wght@0,6..96,400..900;1,6..96,400..900&family=Cormorant+Garamond:ital,wght@0,300..700;1,300..700&family=Crimson+Text:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&family=EB+Garamond:ital,wght@0,400..800;1,400..800&family=Satisfy&display=swap" rel="stylesheet">


<div class="container mt-5">
    <div class="row">
        <div class="col-12 text-center">
            <h1>Welcome Admin</h1>
            <p>Manage menus, transactions, and admin through this dashboard</p>
        </div>
    </div>

    <!-- Statistik -->
    <div class="row mt-4">
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-primary shadow-lg">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <i class="bi bi-boxes" style="font-size: 2rem;"></i>
                    <div class="text-center">
                        <h5 class="card-title">Menu Totals</h5>
                        <p class="card-text fs-4">{{ $totalMenu }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card text-white bg-success shadow-lg">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <i class="bi bi-cart-check" style="font-size: 2rem;"></i>
                    <div class="text-center">
                        <h5 class="card-title">Transactions Totals</h5>
                        <p class="card-text fs-4">{{ $totalTransactions }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Penjualan -->
    <div class="row mt-5">
        <div class="col-12">
            <h4>Monthly Sales Chart</h4>
            <canvas id="salesChart"></canvas>
        </div>
    </div>

    <!-- Aktivitas Terbaru -->
    <div class="row mt-5">
        <div class="col-12">
            <h4>New Activity</h4>
            @if($recentActivities->isEmpty())
                <p>No recent activity</p>
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Activity Name</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recentActivities as $activity)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $activity->description }}</td>
                                <td>{{ $activity->created_at->format('d-m-Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

</div>

@endsection

@push('scripts')
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script> {{-- Tambahkan ini --}}
<script>
    var ctx = document.getElementById('salesChart').getContext('2d');
    var salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode(array_map(fn($m) => "Bulan $m", $months)) !!},
            datasets: [{
                label: 'Penjualan (IDR)',
                data: {!! json_encode($salesData) !!},
                borderColor: 'rgb(75, 192, 192)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Grafik Penjualan Bulanan'
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return 'Rp ' + tooltipItem.raw.toLocaleString();
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString();
                        }
                    }
                }
            }
        }
    });
</script>
@endpush