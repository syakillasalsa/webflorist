@extends('mainlayout')

@section('content')
<!-- Bootstrap 5 CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<div class="container py-5">
    <div class="invoice-wrapper">

        <div class="invoice-header">
            <h2>Payment Summary</h2>
        </div>

        <div class="row">
            <!-- Left Column -->
            <div class="col-md-6 text-left">
                @php
                $checkout = session('checkout_data', []);
                $total = $checkout['subtotal'] ?? 0;
                $shippingMethod = $checkout['shipping_method'] ?? 'pickup';
                $address = $checkout['address'] ?? null;
                $note = $checkout['note'] ?? null;
                @endphp

                @if(!empty($note))
                    <div class="info-block">
                        <div class="section-title">Note:</div>
                        <p>{{ $note }}</p>
                    </div>
                @endif

                <div class="info-block">
                    <div class="section-title">Total Purchase:</div>
                    <h4>Rp {{ number_format($total, 0, ',', '.') }}</h4>
                </div>

                @if($shippingMethod === 'delivery')
                    <div class="info-block">
                        <div class="section-title">Delivery Address:</div>
                        <p>{{ $address }}</p>
                    </div>

                    <div class="info-block">
                        <div class="section-title">Shipping Cost:</div>
                        <p id="shippingCost">Calculating...</p>
                    </div>
                @endif

                <div class="info-block">
                    <div class="section-title">Final Total:</div>
                    <h4 id="totalFinal">Rp {{ number_format($total, 0, ',', '.') }}</h4>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-6">
                <div class="invoice-box">
                    <h5 class="mb-3">Choose Payment Method</h5>
                    <form id="paymentForm" action="{{ route('payment.process') }}" method="POST">
                        @csrf
                        <input type="hidden" name="total_final" id="inputTotalFinal" value="{{ $total }}">

                        <div class="mb-3">
                            <label>Payment Method:</label>
                            <select name="payment_method" id="paymentMethod" class="form-control" required>
                                <option value="" disabled selected>Select a payment method</option>
                                @if($shippingMethod === 'pickup')
                                    <option value="pay_in_store">Pay at Store</option>
                                @endif
                                <option value="bank_transfer">Bank Transfer</option>
                                <option value="qris">QRIS</option>
                            </select>
                        </div>

                        <button type="button" id="payButton" class="btn btn-success w-100" disabled>
                            <i class="fas fa-credit-card"></i> Pay Now
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>


<!-- Payment Instructions Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="paymentModalLabel">Payment Instructions</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="instructionText"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="confirmPaymentBtn">I Have Paid</button>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const paymentMethod = document.getElementById("paymentMethod");
    const payButton = document.getElementById("payButton");
    const shippingCostElement = document.getElementById("shippingCost");
    const totalFinalElement = document.getElementById("totalFinal");
    const inputTotalFinal = document.getElementById("inputTotalFinal");
    const instructionText = document.getElementById("instructionText");
    const form = document.getElementById("paymentForm");

    let totalBelanja = {{ $total }};

    @if($shippingMethod === 'delivery')
    fetch("{{ route('get.shipping.cost', ['address' => $address]) }}")
        .then(response => response.json())
        .then(data => {
            if (data.shipping_cost) {
                let shippingCost = Math.round(data.shipping_cost);
                let totalFinal = totalBelanja + shippingCost;

                shippingCostElement.innerText = `Rp ${shippingCost.toLocaleString('id-ID')}`;
                totalFinalElement.innerText = `Rp ${totalFinal.toLocaleString('id-ID')}`;
                inputTotalFinal.value = totalFinal;
            } else {
                shippingCostElement.innerText = "Unable to calculate shipping.";
            }
        })
        .catch(error => {
            console.error('Error:', error);
            shippingCostElement.innerText = "Failed to retrieve shipping data.";
        });
    @endif

    paymentMethod.addEventListener("change", function() {
        payButton.disabled = !this.value;
    });

    payButton.addEventListener("click", function() {
        const method = paymentMethod.value;

        if (!method) {
            alert("Please select a payment method first.");
            return;
        }

        let instructions = "";

        switch(method) {
            case 'pay_in_store':
                instructions = "<p>Please visit our store and make payment at the cashier.</p>";
                break;
            case 'bank_transfer':
                instructions = `
                    <p>Please transfer to the following bank account:</p>
                    <ul>
                        <li><strong>Bank:</strong> BCA</li>
                        <li><strong>Account Number:</strong> 1234567890</li>
                        <li><strong>Account Name:</strong> Toko Bunga Cantik</li>
                    </ul>
                    <p>After transferring, please confirm via WhatsApp to our admin.</p>
                `;
                break;
            case 'qris':
                instructions = `
                    <p>Please scan the following QR code to make your payment:</p>
                    <img src="{{ asset('images/qris.jpg') }}" alt="QRIS" style="max-width: 300px;">
                `;
                break;
            default:
                instructions = "<p>Unknown payment method.</p>";
        }

        instructionText.innerHTML = instructions;
        const paymentModal = new bootstrap.Modal(document.getElementById('paymentModal'));
        paymentModal.show();
    });

    document.getElementById("confirmPaymentBtn").addEventListener("click", function() {
        form.submit();
    });
});
</script>
@endsection
