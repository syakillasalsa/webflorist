@extends('mainlayout')

@section('content')
<div class="container mt-4">
    <h2>Riwayat Transaksi</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Total Harga</th>
                <th>Metode Pembayaran</th>
                <th>Metode Pengiriman</th>
                <th>Alamat</th>
                <th>Catatan</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $key => $transaction)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                <td>{{ ucfirst($transaction->payment_method) }}</td>
                <td>
                    @if($transaction->delivery_method === 'Diantar')
                        <span class="badge bg-primary">Diantar</span>
                    @elseif($transaction->delivery_method === 'Ambil Sendiri')
                        <span class="badge bg-secondary">Ambil Sendiri</span>
                    @else
                        <span class="badge bg-danger">Tidak Diketahui</span>
                    @endif
                </td>
                <td>
                    @if($transaction->delivery_method === 'Diantar')
                        {{ $transaction->address }}
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>
                <td>{{ $transaction->note ?? 'Tidak ada catatan' }}</td>
                <td>
                    <form action="{{ route('transactions.updateStatus', $transaction->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                            <option value="Waiting Verification" {{ $transaction->status == 'Waiting Verification' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                            <option value="Paid" {{ $transaction->status == 'Paid' ? 'selected' : '' }}>Lunas</option>
                            <option value="Shipped" {{ $transaction->status == 'Shipped' ? 'selected' : '' }}>Dikirim</option>
                            <option value="Cancelled" {{ $transaction->status == 'Cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                    </form>
                </td>
                <td>{{ \Carbon\Carbon::parse($transaction->created_at)->format('d-m-Y H:i') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">Belum ada transaksi.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
