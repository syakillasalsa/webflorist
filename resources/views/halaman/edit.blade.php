@extends('mainlayout')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 55vh;">
    <div class="text-center w-100" style="max-width: 400px;">
        <h2 class="mb-3">Edit Products</h2>

        @if ($errors->any())
            <div class="alert alert-danger text-start">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card p-4 text-start shadow">
            <form action="{{ route('bouquet.update', $bouquet->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Name Products</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $bouquet->name }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required>{{ $bouquet->description }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{ $bouquet->price }}" required>
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-control" id="category" name="category" required>
                        <option value="Bunga" {{ $bouquet->category == 'Bunga' ? 'selected' : '' }}>Flower</option>
                        <option value="Buket" {{ $bouquet->category == 'Buket' ? 'selected' : '' }}>Bouquets</option>
                        <option value="Kertas" {{ $bouquet->category == 'Kertas' ? 'selected' : '' }}>Papper Wrap</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image Products</label>
                    <input type="file" class="form-control" id="image" name="image">
                    <small class="text-muted">Leave blank if you don't want to change the image</small>
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $bouquet->image) }}" alt="Buket Bunga" width="100" class="img-thumbnail">
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn-primary">Save</button>
                    <a href="{{ route('order.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
