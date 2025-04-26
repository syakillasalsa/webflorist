@extends('mainlayout')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
    <h4 class="mb-0">Pembayaran Berhasil</h4>
</div>

        <div class="card-body">
            <p class="text-success"><strong>Terima kasih!</strong> Transaksi Anda telah berhasil.</p>

            <div class="mb-3">
                <strong>No. Nota:</strong> {{ $transaction->id }} <br>
                <strong>Tanggal Cetak:</strong> {{ \Carbon\Carbon::now()->format('d-m-Y H:i') }}
            </div>

            <h5>Informasi Transaksi</h5>
            <table class="table table-bordered">
                <tr>
                    <th>ID Transaksi</th>
                    <td>{{ $transaction->id }}</td>
                </tr>
                <tr>
                    <th>Nama Pelanggan</th>
                    <td>{{ $transaction->user->name }}</td>
                </tr>
                <tr>
                    <th>Metode Pembayaran</th>
                    <td>{{ ucfirst($transaction->payment_method) }}</td>
                </tr>
                <tr>
                    <th>Metode Pengiriman</th>
                    <td>{{ ucfirst($transaction->delivery_method ?? $transaction->shipping_method) }}</td>
                </tr>
                @if($transaction->address)
                <tr>
                    <th>Alamat</th>
                    <td>{{ $transaction->address }}</td>
                </tr>
                @endif
                @if($transaction->note)
                <tr>
                    <th>Catatan</th>
                    <td>{{ $transaction->note }}</td>
                </tr>
                @endif
                <tr>
                    <th>Status</th>
                    <td><span class="badge bg-success">Transaksi Berhasil</span></td>
                </tr>

                @if($transaction->pickup_date || $transaction->pickup_time)
                <tr>
                    <th>Tanggal & Jam Pengambilan</th>
                    <td>
                        {{ $transaction->pickup_date ? \Carbon\Carbon::parse($transaction->pickup_date)->format('d-m-Y') : '' }}
                        {{ $transaction->pickup_time ? \Carbon\Carbon::parse($transaction->pickup_time)->format('H:i') : '' }}
                    </td>
                </tr>
                @endif

                @if($transaction->delivery_date || $transaction->delivery_time)
                <tr>
                    <th>Tanggal & Jam Pengiriman</th>
                    <td>
                        {{ $transaction->delivery_date ? \Carbon\Carbon::parse($transaction->delivery_date)->format('d-m-Y') : '' }}
                        {{ $transaction->delivery_time ? \Carbon\Carbon::parse($transaction->delivery_time)->format('H:i') : '' }}
                    </td>
                </tr>
                @endif
            </table>

            <h5 class="mt-4">Detail Item</h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama Bouquet</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaction->transactionItems as $item)
                        <tr>
                            <td>{{ $item->bouquet->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                            <td>Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h5 class="mt-3">Ringkasan Pembayaran</h5>
            <table class="table table-borderless">
                <tr>
                    <th>Total Belanja:</th>
                    <td>Rp{{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Ongkir:</th>
                    <td>Rp{{ number_format($transaction->shipping_cost ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th><strong>Total Pembayaran:</strong></th>
                    <td><strong>Rp{{ number_format($transaction->total_payment, 0, ',', '.') }}</strong></td>
                </tr>
            </table>

            <a href="{{ route('home') }}" class="btn btn-primary mt-3">Kembali ke Beranda</a>
        </div>
    </div>
</div>
@endsection
