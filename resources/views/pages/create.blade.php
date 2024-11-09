@extends('layout.app')
@section('content')
    <div class="container my-4 px-5">
        <div class="d-flex justify-content-between mb-3">
            <h2>Add New Product</h2>
            <a href="{{ route('product.index') }}" class="btn btn-primary px-4">Back</a>
        </div>

        <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="product_id" class="form-label">Product ID</label>
                <input type="text" class="form-control" id="product_id" name="product_id" placeholder="Enter Product ID"
                    required>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Product Name"
                    required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"
                    placeholder="Enter Product Description"></textarea>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" placeholder="Enter Product Price"
                    required>
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock" placeholder="Enter Stock Quantity">
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Product Image</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>

            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
    </div>
@endsection
