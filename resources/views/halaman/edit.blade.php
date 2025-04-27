@extends('mainlayout')

@section('content')

<div class="container py-5">
    <h1 class="text-center mb-4">Edit Buket Bunga</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card p-4">
        <form action="{{ route('bouquet.update', $bouquet->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nama Buket</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $bouquet->name }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="3" required>{{ $bouquet->description }}</textarea>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Harga</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ $bouquet->price }}" required>
            </div>
            <div class="mb-3">
    <label for="category" class="form-label">Kategori</label>
    <select class="form-control" id="category" name="category" required>
        <option value="Bunga" {{ $bouquet->category == 'Bunga' ? 'selected' : '' }}>Bunga</option>
        <option value="Buket" {{ $bouquet->category == 'Buket' ? 'selected' : '' }}>Buket</option>
        <option value="Kertas" {{ $bouquet->category == 'Kertas' ? 'selected' : '' }}>Kertas</option>
    </select>
</div>

            <div class="mb-3">
                <label for="image" class="form-label">Gambar Buket</label>
                <input type="file" class="form-control" id="image" name="image">
                <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
                <br>
                <img src="{{ asset('storage/' . $bouquet->image) }}" alt="Buket Bunga" width="150" class="mt-2">
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('order.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

@endsection
