@extends('mainlayout')

@section('content')
<div class="container">
    <h2 class="mb-4">Tambah Menu Bunga</h2>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('bouquet.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="name">Nama Buket:</label>
        <input type="text" name="name" id="name" required>

        <label for="description">Deskripsi:</label>
        <textarea name="description" id="description" required></textarea>

        <label for="price">Harga:</label>
        <input type="number" name="price" id="price" required>

        <label for="category">Kategori:</label>
        <select name="category" id="category" required>
            <option value="Bunga">Bunga</option>
            <option value="Buket">Buket</option>
            <option value="Kertas">Kertas</option>
        </select>

        <label for="image">Gambar:</label>
        <input type="file" name="image" id="image" required>

        <button type="submit">Tambah</button>
    </form>
</div>
@endsection
