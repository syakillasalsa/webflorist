@extends('mainlayout')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">Add Products</h2>

    @if ($errors->any())
        <div class="alert alert-danger w-100 mx-auto" style="max-width: 600px;">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="order-card">
        <form action="{{ route('bouquet.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3 text-start">
                <label for="name" class="form-label">Products Name:</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="mb-3 text-start">
                <label for="description" class="form-label">Description:</label>
                <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
            </div>

            <div class="mb-3 text-start">
                <label for="price" class="form-label">Price:</label>
                <input type="number" name="price" id="price" class="form-control" min="0" required>
            </div>

            <div class="mb-3 text-start">
                <label for="category" class="form-label">Category:</label>
                <select name="category" id="category" class="form-select" required>
                    <option value="Bunga">Flower</option>
                    <option value="Buket">Bouquet</option>
                    <option value="Kertas">Papper Wrap</option>
                </select>
            </div>

            <div class="mb-4 text-start">
                <label for="image" class="form-label">Image:</label>
                <input type="file" name="image" id="image" class="form-control" required>
            </div>

            <button type="submit" class="custom-btn">Add</button>
        </form>
    </div>
</div>
@endsection
