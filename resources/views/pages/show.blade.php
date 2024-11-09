@extends('layout.app')
@section('content')
    <div class="container center my-5">
      <div class="position-absolute top-50 start-50 translate-middle">
        <div class="card mb-3 h-100" style="width: 600px;">
          <div class="row g-0">
              <div class="col-md-4">
                  <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded-start" alt="...">
              </div>
              <div class="col-md-8">
                  <div class="card-body">
                      <h4 class="card-title">{{ $product->product_id }}</h4>
                      <h5 class="card-subtitle">{{ $product->name }}</h5>
                      <p class="card-text">{{ $product->description }}</p>
                      <div class="d-flex justify-content-between"><span class="">{{ $product->price }}</span> <span
                              class="">{{ $product->stock }}</span></div>
                  </div>
              </div>
          </div>
      </div>
      </div>
{{-- start --}}
       {{-- <div class="position-absolute top-50 start-50 translate-middle">
        <div class="card" style="width: 15rem;">
          <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top p-3" alt="...">
          <div class="card-body">
            <h4 class="card-title">ID: {{ $product->product_id }}</h4>
                              <h5 class="card-subtitle my-2">Name:{{ $product->name }}</h5>
                              <p class="card-text my-3">{{ $product->description }}</p> </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Price: {{ $product->price }}</li>
            <li class="list-group-item">Stock: {{ $product->stock }}</li>
            
          </ul>
          <div class="card-body">
            <a href="{{ route('product.index') }}" class="btn btn-primary">Card link</a>
            
          </div>
        </div>
      </div> 


    </div> --}}
@endsection
