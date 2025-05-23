@extends('mainlayout')

@section('content')
<div class="container py-4">
    <h2 class="text-center mb-4">CHECKOUT</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(count($cart) > 0)
    <div class="row">

        <!-- Kolom Kiri - Ringkasan Keranjang -->
        <div class="col-md-5 order-md-1">
            @foreach($cart as $id => $item)
            <div class="border-bottom py-3 d-flex align-items-center">
                <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" width="80" class="me-3">
                <div class="flex-grow-1">
                    <h5>{{ $item['name'] }}</h5>
                    <p class="text-muted">Rp{{ number_format($item['price'], 0, ',', '.') }}</p>
                    <div class="d-inline-flex align-items-center">
                        <a href="{{ route('cart.decrease', $id) }}" class="btn btn-outline-secondary btn-sm">−</a>
                        <input type="text" class="form-control text-center mx-1" value="{{ $item['quantity'] }}" style="width: 50px;" readonly>
                        <a href="{{ route('cart.increase', $id) }}" class="btn btn-outline-secondary btn-sm">+</a>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <p class="mb-0 me-3"><strong>Rp{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</strong></p>
                    <a href="{{ route('cart.remove', $id) }}">
                        <i class="fas fa-trash-alt" style="color: gray; font-size: 18px;"></i>
                    </a>
                </div>
            </div>
            @endforeach

            <h5 class="mt-4">Total: <strong>Rp{{ number_format($subtotal, 0, ',', '.') }}</strong></h5>

            <div class="text-center mt-3">
                <a href="{{ route('menu.filter') }}" class="btn btn-secondary">Back To Menu</a>
            </div>
        </div>

        <!-- Kolom Kanan - Form Checkout -->
        <div class="col-md-7 order-md-2">
            <form id="checkoutForm" action="{{ route('checkout.process') }}" method="POST">
                @csrf
                <input type="hidden" name="total" value="{{ $subtotal }}">
                <input type="hidden" name="note" id="hiddenNote">

                <!-- Catatan -->
                <div class="mb-4">
                    <h5><em>ADD NOTES</em></h5>
                    <textarea id="note" class="form-control" rows="3">{{ old('note', session('checkout_data.note')) }}</textarea>
                </div>

                <!-- Metode Pengiriman -->
                <div class="mb-4">
                    <h5><em>Delivery Option</em></h5>
                    <hr>

                    <div class="mb-3">
                        <label for="shippingMethod">PICK YOUR DELIVERY:</label>
                        <select id="shippingMethod" name="shipping_method" class="form-control" required>
                            <option value="pickup" {{ old('shipping_method') == 'pickup' ? 'selected' : '' }}>Self Pick-Up</option>
                            <option value="delivery" {{ old('shipping_method') == 'delivery' ? 'selected' : '' }}>Deliver To Your Location</option>
                        </select>
                    </div>

                    <div id="addressField" class="mb-3" style="display: none;">
                        <label>Address:</label>
                        <textarea name="address" class="form-control">{{ old('address') }}</textarea>
                    </div>

                    <div id="storeAddress" class="mb-3" style="display: none;">
                        <label>Store Address:</label>
                        <p class="border p-2">Jl. Contoh No.123, Kota XYZ</p>
                    </div>

                    <div id="pickupDateField" class="mb-3" style="display: none;">
                        <label>Pickup Date:</label>
                        <input type="date" name="pickup_date" class="form-control" value="{{ old('pickup_date') }}">
                    </div>

                    <div id="pickupTimeField" class="mb-3" style="display: none;">
                        <label>Pickup Time:</label>
                        <input type="time" name="pickup_time" class="form-control" value="{{ old('pickup_time') }}">
                    </div>

                    <div id="deliveryDateField" class="mb-3" style="display: none;">
                        <label>Delivery Date:</label>
                        <input type="date" name="delivery_date" class="form-control" value="{{ old('delivery_date') }}">
                    </div>

                    <div id="deliveryTimeField" class="mb-4" style="display: none;">
                        <label>Delivery Time:</label>
                        <input type="time" name="delivery_time" class="form-control" value="{{ old('delivery_time') }}">
                    </div>
                </div>

                <button type="submit" id="submitButton" class="btn btn-primary w-100">Payment</button>
            </form>
        </div>

    </div>
    @else
        <p class="text-center">Your Cart Is Empty</p>
        <div class="text-center">
            <a href="{{ route('menu.filter') }}" class="btn btn-primary">Back To Menu</a>
        </div>
    @endif
</div>

<!-- Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const shippingMethod = document.getElementById('shippingMethod');
    const addressField = document.getElementById('addressField');
    const storeAddress = document.getElementById('storeAddress');
    const pickupDateField = document.getElementById('pickupDateField');
    const pickupTimeField = document.getElementById('pickupTimeField');
    const deliveryDateField = document.getElementById('deliveryDateField');
    const deliveryTimeField = document.getElementById('deliveryTimeField');
    const noteTextarea = document.getElementById('note');
    const hiddenNoteInput = document.getElementById('hiddenNote');
    const checkoutForm = document.getElementById('checkoutForm');
    const submitButton = document.getElementById('submitButton');

    function updateFormState() {
        let isValid = true;

        if (shippingMethod.value === 'delivery') {
            addressField.style.display = 'block';
            storeAddress.style.display = 'none';
            pickupDateField.style.display = 'none';
            pickupTimeField.style.display = 'none';
            deliveryDateField.style.display = 'block';
            deliveryTimeField.style.display = 'block';

            const deliveryDate = document.querySelector('input[name="delivery_date"]').value.trim();
            const deliveryTime = document.querySelector('input[name="delivery_time"]').value.trim();
            const address = document.querySelector('textarea[name="address"]').value.trim();

            isValid = deliveryDate && deliveryTime && address;
        } else if (shippingMethod.value === 'pickup') {
            addressField.style.display = 'none';
            storeAddress.style.display = 'block';
            pickupDateField.style.display = 'block';
            pickupTimeField.style.display = 'block';
            deliveryDateField.style.display = 'none';
            deliveryTimeField.style.display = 'none';

            const pickupDate = document.querySelector('input[name="pickup_date"]').value.trim();
            const pickupTime = document.querySelector('input[name="pickup_time"]').value.trim();

            isValid = pickupDate && pickupTime;
        } else {
            isValid = false;
        }

        submitButton.disabled = !isValid;
    }

    shippingMethod.addEventListener('change', updateFormState);
    checkoutForm.addEventListener('input', updateFormState);
    checkoutForm.addEventListener('submit', function(e) {
        hiddenNoteInput.value = noteTextarea.value.trim();
    });

    // Inisialisasi tampilan awal
    updateFormState();
});
</script>
@endsection
