@extends('mainlayout')

@section('content')
<div class="container">
    <h2>Checkout</h2>
    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Total Amount:</label>
            <h4>Rp {{ number_format($total, 0, ',', '.') }}</h4>
            <input type="hidden" name="total" value="{{ $total }}">
        </div>

        <div class="mb-3">
            <label>Deivery Method:</label>
            <select id="shippingMethod" name="shipping_method" class="form-control" required>
    <option value="pickup" {{ old('shipping_method') == 'pickup' ? 'selected' : '' }}>Pickup in Store</option>
    <option value="delivery" {{ old('shipping_method') == 'delivery' ? 'selected' : '' }}>Deliver to Your Location</option>

            </select>
        </div>

        <div id="addressField" class="mb-3" style="display: none;">
            <label>Delivery Address:</label>
            <textarea name="address" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">PAYMENT</button>
    </form>
</div>

<script>
document.getElementById('shippingMethod').addEventListener('change', function() {
    if (this.value === 'delivery') {
        document.getElementById('addressField').style.display = 'block';
    } else {
        document.getElementById('addressField').style.display = 'none';
    }
});
</script>
@endsection
