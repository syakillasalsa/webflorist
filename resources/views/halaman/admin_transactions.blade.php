@extends('mainlayout')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">Riwayat Transaksi</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nama Pelanggan</th>
                        <th>Metode Pembayaran</th>
                        <th>Metode Pengiriman</th>
                        <th>Status</th>
                        <th>Total Pembayaran</th>
                        <th>Tanggal Transaksi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->id }}</td>
                            <td>{{ $transaction->user->name }}</td>
                            <td>{{ ucfirst($transaction->payment_method) }}</td>
                            <td>{{ ucfirst($transaction->delivery_method ?? '-') }}</td>
                            <td>
                                <span class="badge bg-info">{{ ucfirst($transaction->status) }}</span>
                            </td>
                            <td>Rp{{ number_format($transaction->total_payment, 0, ',', '.') }}</td>
                            <td>{{ $transaction->created_at->format('d-m-Y H:i') }}</td>
                            <td>
                                <a href="{{ route('transaction.detail', $transaction->id) }}" class="btn btn-sm btn-primary">Lihat</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
