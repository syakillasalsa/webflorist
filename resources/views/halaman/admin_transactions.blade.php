@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">Transaction History</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name Customer</th>
                        <th>Payment Method</th>
                        <th>Delivery Method</th>
                        <th>Status</th>
                        <th>Totals Payment</th>
                        <th>Date Transaction</th>
                        <th>Action</th>
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
                            <td colspan="8" class="text-center">No Transaction Available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
