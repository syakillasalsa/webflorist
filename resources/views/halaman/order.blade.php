@extends('layouts.admin')

@section('content')
<style>
    .table-container {
        background-color: #fff0f5;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(255, 192, 203, 0.2);
    }

    .table thead.table-dark th {
        background-color: #9EC6F3 !important;
        color: white;
        border: none;
        vertical-align: middle;
    }

    .table tbody tr:hover {
        background-color: #DBDBDB;
    }

    .table-bordered th, 
    .table-bordered td {
        border: 1px solid #000;
    }

    .table td, 
    .table th {
        vertical-align: middle;
    }

    .btn-primary {
        background-color: #9EC6F3;
        border-color: #9EC6F3;
    }

    .btn-primary:hover {
        background-color: #BDDDE4;
        border-color: #BDDDE4;
    }

    .text-danger {
        color: #000 !important;
    }
</style>


<div class="container py-2">
    <h1 class="text-center mb-4" style="font-family: 'Cormorant Garamond', serif; color: #000000;">LIST FLOWER BOUQUETS</h1>

    <div class="text-end mb-3">
        <a href="{{ route('bouquet.create') }}" class="btn btn-primary">Add Product</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center bg-white shadow-sm rounded">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name Bouquets</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bouquets as $bouquet)
                    <tr>
                        <td>{{ $bouquet->id }}</td>
                        <td>{{ $bouquet->name }}</td>
                        <td class="text-start">{{ $bouquet->description }}</td>
                        <td class="text-danger">Rp {{ number_format($bouquet->price, 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('bouquet.updateCategory', $bouquet->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="category" class="form-select" onchange="this.form.submit()">
                                    <option value="Bunga" {{ $bouquet->category == 'Bunga' ? 'selected' : '' }}>Flower</option>
                                    <option value="Buket" {{ $bouquet->category == 'Buket' ? 'selected' : '' }}>Bouquets</option>
                                    <option value="Kertas" {{ $bouquet->category == 'Kertas' ? 'selected' : '' }}>Papper Wrap</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <img src="{{ asset('storage/' . $bouquet->image) }}" alt="{{ $bouquet->name }}" width="100" class="rounded">
                        </td>
                        <td>
                            <a href="{{ route('bouquet.edit', $bouquet->id) }}" class="btn btn-primary btn-sm mb-1">Edit</a>
                            <form action="{{ route('bouquet.destroy', $bouquet->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection
