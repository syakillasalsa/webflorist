<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Transaction Receipt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
</head>
<body>
    <div class="nota-wrapper d-flex justify-content-center mt-4">
        <div class="nota-card shadow w-100" style="max-width: 900px;">
            <div class="nota-header bg-success text-white text-center">
                <h4 class="mb-0">PAYMENT SUCCESS</h4>
            </div>
            <div class="nota-body">
                <div class="nota-info text-center mb-4">
                    <p class="text-success fw-bold">Thank you! Your transaction was successful.</p>
                    <p><strong>Receipt No.:</strong> {{ $transaction->id }}</p>
                    <p><strong>Printed Date:</strong> {{ \Carbon\Carbon::now()->format('d-m-Y H:i') }}</p>
                </div>

                <h5 class="text-center">Transaction Information</h5>
                <table class="table table-bordered">
                    <tr>
                        <th>Transaction ID</th>
                        <td>{{ $transaction->id }}</td>
                    </tr>
                    <tr>
                        <th>Customer Name</th>
                        <td>{{ $transaction->user->name }}</td>
                    </tr>
                    <tr>
                        <th>Payment Method</th>
                        <td>{{ ucfirst($transaction->payment_method) }}</td>
                    </tr>
                    <tr>
                        <th>Delivery Method</th>
                        <td>{{ ucfirst($transaction->delivery_method ?? $transaction->shipping_method) }}</td>
                    </tr>
                    @if($transaction->address)
                    <tr>
                        <th>Address</th>
                        <td>{{ $transaction->address }}</td>
                    </tr>
                    @endif
                    @if($transaction->note)
                    <tr>
                        <th>Note</th>
                        <td>{{ $transaction->note }}</td>
                    </tr>
                    @endif
                    <tr>
                        <th>Status</th>
                        <td><span class="badge bg-success">Transaction Successful</span></td>
                    </tr>
                    @if($transaction->pickup_date || $transaction->pickup_time)
                    <tr>
                        <th>Pickup Date & Time</th>
                        <td>
                            {{ $transaction->pickup_date ? \Carbon\Carbon::parse($transaction->pickup_date)->format('d-m-Y') : '' }}
                            {{ $transaction->pickup_time ? \Carbon\Carbon::parse($transaction->pickup_time)->format('H:i') : '' }}
                        </td>
                    </tr>
                    @endif
                    @if($transaction->delivery_date || $transaction->delivery_time)
                    <tr>
                        <th>Delivery Date & Time</th>
                        <td>
                            {{ $transaction->delivery_date ? \Carbon\Carbon::parse($transaction->delivery_date)->format('d-m-Y') : '' }}
                            {{ $transaction->delivery_time ? \Carbon\Carbon::parse($transaction->delivery_time)->format('H:i') : '' }}
                        </td>
                    </tr>
                    @endif
                </table>

                <h5 class="text-center mt-4">Item Details</h5>
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Bouquet Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
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

                <h5 class="text-center mt-4">Payment Summary</h5>
                <table class="table table-borderless w-50 mx-auto">
                    <tr>
                        <th>Total Purchase:</th>
                        <td class="text-end">Rp{{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Shipping Cost:</th>
                        <td class="text-end">Rp{{ number_format($transaction->shipping_cost ?? 0, 0, ',', '.') }}</td>
                    </tr>
                    <tr class="fw-bold">
                        <th>Total Payment:</th>
                        <td class="text-end">Rp{{ number_format($transaction->total_payment, 0, ',', '.') }}</td>
                    </tr>
                </table>

                <div class="nota-footer text-center mt-4">
                    <a href="{{ route('home') }}" class="btn btn-primary">Back to Home</a>
                    <a href="{{ route('transactions.download', $transaction->id) }}" class="btn btn-danger ms-2">Download Receipt PDF</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
