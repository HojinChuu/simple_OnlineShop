@extends('layouts.app')

@section('content')
    <h1>Create a product</h1>
    <form action="{{ route('products.store') }}" method="post">
        @csrf
        <div class="form-row">
            <label for="title">Title</label>
            <input class="form-control" type="text" name="title" value="{{ old('title') }}" required>
        </div>
        <div class="form-row">
            <label for="description">Description</label>
            <input class="form-control" type="text" name="description" value="{{ old('description') }}" required>
        </div>
        <div class="form-row">
            <label for="price">Price</label>
            <input class="form-control" type="number" min="1.00" step="0.01" name="price" value="{{ old('price') }}" required>
        </div>
        <div class="form-row">
            <label for="stock">Stock</label>
            <input class="form-control" type="number" min="0" name="stock" value="{{ old('stock') }}" required>
        </div>
        <div class="form-row">
            <label for="status">Status</label>
            <select class="custom-select" name="status" required>
                <option value="" selected>Select...</option>
                <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>
                    Available
                </option>
                <option value="unavailable" {{ old('status') == 'unavailable' ? 'selected' : '' }}>
                    Unavailable
                </option>
            </select>
        </div>
        <div class="form-row">
            <button type="submit" class="btn btn-primary btn-lg mt-3">Create Product</button>
        </div>
    </form>
@endsection
