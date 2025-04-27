@extends('mainlayout')

@section('content')
<!-- Bootstrap 5 CDN langsung di halaman -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<div class="container py-4">
    <h2>Pembayaran</h2>

    <div class="row">
        <!-- Kolom Kiri -->
        <div class="col-md-6">
            @php
            $checkout = session('checkout_data', []);
            $total = $checkout['subtotal'] ?? 0; 
            $shippingMethod = $checkout['shipping_method'] ?? 'pickup';
            $address = $checkout['address'] ?? null;
            $note = $checkout['note'] ?? null;
            @endphp

            @if(!empty($note))
                <div class="mb-3">
                    <label>Catatan:</label>
                    <p>{{ $note }}</p>
                </div>
            @endif

            <div class="mb-3">
                <label>Total Belanjaan:</label>
                <h4>Rp {{ number_format($total, 0, ',', '.') }}</h4>
            </div>

            @if($shippingMethod === 'delivery')
                <div class="mb-3">
                    <label>Alamat Tujuan:</label>
                    <p>{{ $address }}</p>
                </div>
                
                <div class="mb-3">
                    <label>Ongkos Kirim:</label>
                    <p id="shippingCost">Menghitung...</p>
                </div>
            @endif

            <div class="mb-3">
                <label>Total Akhir:</label>
                <h4 id="totalFinal">Rp {{ number_format($total, 0, ',', '.') }}</h4>
            </div>
        </div>

        <!-- Kolom Kanan -->
        <div class="col-md-6">
            <div class="p-4 border rounded">
                <h5 class="mb-3">Pilih Metode Pembayaran</h5>
                <form id="paymentForm" action="{{ route('payment.process') }}" method="POST">
                    @csrf
                    <input type="hidden" name="total_final" id="inputTotalFinal" value="{{ $total }}">
                    
                    <div class="mb-3">
                        <label>Metode Pembayaran:</label>
                        <select name="payment_method" id="paymentMethod" class="form-control" required>
                            <option value="" disabled selected>Pilih metode pembayaran</option>
                            @if($shippingMethod === 'pickup')
                                <option value="pay_in_store">Bayar di Toko</option>
                            @endif
                            <option value="bank_transfer">Transfer Bank</option>
                            <option value="qris">QRIS</option>
                        </select>
                    </div>

                    <button type="button" id="payButton" class="btn btn-success w-100 fw-bold" disabled>
                        <i class="fas fa-credit-card"></i> Bayar Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Instruksi Pembayaran -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="paymentModalLabel">Instruksi Pembayaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body" id="instructionText"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary" id="confirmPaymentBtn">Saya Sudah Bayar</button>
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
                shippingCostElement.innerText = "Tidak dapat menghitung ongkir.";
            }
        })
        .catch(error => {
            console.error('Error:', error);
            shippingCostElement.innerText = "Gagal mengambil data ongkir.";
        });
    @endif

    paymentMethod.addEventListener("change", function() {
        payButton.disabled = !this.value;
    });

    payButton.addEventListener("click", function() {
        const method = paymentMethod.value;

        if (!method) {
            alert("Silakan pilih metode pembayaran terlebih dahulu.");
            return;
        }

        let instructions = "";

        switch(method) {
            case 'pay_in_store':
                instructions = "<p>Silakan datang ke toko kami dan lakukan pembayaran di kasir.</p>";
                break;
            case 'bank_transfer':
                instructions = `
                    <p>Silakan transfer ke rekening berikut:</p>
                    <ul>
                        <li><strong>Bank:</strong> BCA</li>
                        <li><strong>No. Rekening:</strong> 1234567890</li>
                        <li><strong>Atas Nama:</strong> Toko Bunga Cantik</li>
                    </ul>
                    <p>Setelah transfer, silakan konfirmasi ke admin melalui WhatsApp.</p>
                `;
                break;
            case 'qris':
                instructions = `
                    <p>Silakan scan QR code berikut untuk melakukan pembayaran:</p>
                    <img src="{{ asset('img/qris-example.png') }}" alt="QRIS" style="max-width: 300px;">
                `;
                break;
            default:
                instructions = "<p>Metode pembayaran tidak dikenali.</p>";
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
