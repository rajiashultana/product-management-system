@extends('layout.app')
@section('content')
    <div class="container my-4">
        <div class="d-flex justify-content-between mb-3">
            <h2>Update New Product</h2>
            <a href="{{ route('product.index') }}" class="btn btn-primary px-4">Back</a>
        </div>
        <form method="POST" action="{{ route('product.update', $products->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="product_id" class="form-label">Product ID</label>
                <input type="text" class="form-control" id="product_id" name="product_id"
                    value="{{ $products->product_id }}" required>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $products->name }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ $products->description }}</textarea>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ $products->price }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock" value="{{ $products->stock }}">
            </div>

            <div>
                <label for="image">Current Image:</label>
                @if ($products->image)
                    <img src="{{ asset('storage/' . $products->image) }}" alt="{{ $products->name }}" width="200">
                @else
                    <p>No image available.</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Product Image</label>
                <input type="file" class="form-control" id="image" name="image" value="{{ $products->image }}">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
