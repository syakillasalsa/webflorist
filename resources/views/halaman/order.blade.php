@extends('mainlayout')

@section('content')

<div class="container py-5">
    <h1 class="text-center mb-4">Daftar Buket Bunga</h1>

    <div class="text-end mb-3">
        <a href="{{ route('bouquet.create') }}" class="btn btn-success">Tambah Buket Bunga</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama Buket</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Kategori</th>
                    <th>Gambar</th>
                    <th>Aksi</th>  <!-- Tambahkan kolom aksi -->
                </tr>
            </thead>
            <tbody>
                @foreach ($bouquets as $bouquet)
                    <tr>
                        <td>{{ $bouquet->id }}</td>
                        <td>{{ $bouquet->name }}</td>
                        <td>{{ $bouquet->description }}</td>
                        <td>Rp {{ number_format($bouquet->price, 0, ',', '.') }}</td>
                        <td>
                            <!-- Form untuk ubah kategori -->
                            <form action="{{ route('bouquet.updateCategory', $bouquet->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="category" class="form-select" onchange="this.form.submit()">
                                    <option value="Bunga" {{ $bouquet->category == 'Bunga' ? 'selected' : '' }}>Bunga</option>
                                    <option value="Buket" {{ $bouquet->category == 'Buket' ? 'selected' : '' }}>Buket</option>
                                    <option value="Kertas" {{ $bouquet->category == 'Kertas' ? 'selected' : '' }}>Kertas</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <img src="{{ asset('storage/' . $bouquet->image) }}" alt="{{ $bouquet->name }}" width="100">
                        </td>
                        <td>
                            <!-- Tombol Edit -->
                            <a href="{{ route('bouquet.edit', $bouquet->id) }}" class="btn btn-primary btn-sm">Edit</a>

                            <!-- Tombol Hapus -->
                            <form action="{{ route('bouquet.destroy', $bouquet->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
