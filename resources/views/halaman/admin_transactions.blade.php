@extends('mainlayout')

@section('content')
<div class="container">
    <h2>Riwayat Transaksi - Admin</h2>
    
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>User</th>
                <th>Total Harga</th>
                <th>Metode Pembayaran</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $key => $transaction)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $transaction->user->name }}</td>
                <td>Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                <td>{{ $transaction->payment_method }}</td>
                <td>
                    @if($transaction->status === 'Waiting Verification')
                        <span class="badge bg-warning">Menunggu Verifikasi</span>
                    @elseif($transaction->status === 'Paid')
                        <span class="badge bg-success">Lunas</span>
                    @elseif($transaction->status === 'Shipped')
                        <span class="badge bg-info">Dikirim</span>
                    @else
                        <span class="badge bg-secondary">{{ $transaction->status }}</span>
                    @endif
                </td>
                <td>{{ $transaction->created_at->format('d-m-Y H:i') }}</td>
                <td>
                    <a href="#" class="btn btn-sm btn-info">Detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
