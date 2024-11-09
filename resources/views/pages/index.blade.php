@extends('layout.app')
@section('content')
    <div class="container my-4 py-3">
        <div class="d-flex justify-content-between mb-3">
            <h2>Product List</h2>
            <a href="{{ route('product.create') }}" class="btn btn-primary">Add Product</a>
        </div>

        <form action="{{ route('product.index') }}" method="get" class="">
            <div class="row justify-content-between align-items-center my-2">
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" name="search" placeholder="Search by Porduct ID or Description...."
                            value="{{ request('search') }}" class="form-control">
                        <button type="submit" class="btn btn-primary">Search </button>

                    </div>
                </div>
                <div class="col-md-2  justify-content-end">
                    <select name="sort_by" class="form-select" onchange="this.form.submit()">
                        <option value="">Sort by</option>
                        <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Name</option>
                        <option value="price" {{ request('sort_by') == 'price' ? 'selected' : '' }}>Price</option>
                    </select>
                    <input type="hidden" name="sort_order" value="{{ request('sort_order') == 'asc' ? 'desc' : 'asc' }}">

                </div>
                @if (request()->has('search') || request()->has('sort_by') || request()->has('sort_order'))
                    <a href="{{ route('product.index') }}" class="btn btn-secondary my-2">Clear</a>
                @endif
            </div>

        </form>


        <div class="row">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Product ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="productTable">

                    @forelse ($products as $product)
                        <tr class="text-center" onclick="redirectToShow(event, '{{ route('product.show', $product->id) }}')"
                            style="cursor: pointer;">
                            <td>{{ $product->product_id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->stock }}</td>
                            <td><img src="{{ asset('storage/' . $product->image) }}" class="" alt="Product Image"
                                    width="150" height="100"></td>
                            <td>
                                <div class="d-flex justify-content-evenly">
                                    <a href="{{ route('product.edit', $product->id) }}"
                                        class="btn btn-sm btn-warning">Edit</a>
                                    <!-- Delete Button -->
                                    <form action="{{ route('product.destroy', $product->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this product?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger delete-button">Delete</button>
                                    </form>
                                </div>


                            </td>
                        </tr>


                    @empty
                        <tr class="">
                            <td class=""> No Product Found</td>
                        </tr>
                    @endforelse


                </tbody>
            </table>

            <div class="d-flex justify-content-between">
                <p>
                    Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} out of {{ $products->total() }}
                    results
                </p>
                <!-- Pagination Links -->
                {{ $products->links() }}
               
            </div>

        </div>
        <script>
            function redirectToShow(event, url) {
                // Check if the clicked element has the class 'delete-button' or is inside a form
                if (!event.target.classList.contains('delete-button') && !event.target.closest('form')) {
                    window.location.href = url;
                }
            }
        </script>
    @endsection
