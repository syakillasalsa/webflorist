<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nota Transaksi</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 5px; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
    <h2 class="text-center">Nota Transaksi</h2>
    <p><strong>No. Nota:</strong> {{ $transaction->id }}</p>
    <p><strong>Tanggal Cetak:</strong> {{ \Carbon\Carbon::now()->format('d-m-Y H:i') }}</p>

    <h4>Informasi Transaksi</h4>
    <table>
        <tr><th>Nama Pelanggan</th><td>{{ $transaction->user->name }}</td></tr>
        <tr><th>Metode Pembayaran</th><td>{{ ucfirst($transaction->payment_method) }}</td></tr>
        <tr><th>Metode Pengiriman</th><td>{{ ucfirst($transaction->delivery_method ?? $transaction->shipping_method) }}</td></tr>
        @if($transaction->address)
        <tr><th>Alamat</th><td>{{ $transaction->address }}</td></tr>
        @endif
    </table>

    <h4>Detail Item</h4>
    <table>
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

    <h4>Ringkasan Pembayaran</h4>
    <table>
        <tr><th>Total Belanja</th><td>Rp{{ number_format($transaction->total_amount, 0, ',', '.') }}</td></tr>
        <tr><th>Ongkir</th><td>Rp{{ number_format($transaction->shipping_cost ?? 0, 0, ',', '.') }}</td></tr>
        <tr><th>Total Pembayaran</th><td><strong>Rp{{ number_format($transaction->total_payment, 0, ',', '.') }}</strong></td></tr>
    </table>
</body>
</html>
