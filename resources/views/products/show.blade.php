@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $product->name }}</div>

                    <div class="card-body position-relative">
                        <p><strong>ID:</strong> {{ $product->id }}</p>
                        <p><strong>Name:</strong> {{ $product->name }}</p>
                        <p><strong>Price:</strong> {{ $product->price }}</p>
                        <p><strong>Quantity:</strong> {{ $product->pivot->quantity }}</p>
                        <p><strong>Date importation:</strong> {{ $product->importation_date }}</p>
                        <p><strong>Date expiration:</strong> {{ $product->expiration_date }}</p>
                        <img src="{{ asset('images/products/' . $product->image) }}" width="250"
                             class="z-1 position-absolute end-0 top-0" alt="{{ $product->name }}">

                        <a href="{{ route('products.edit', ['product' => $product->id]) }}" class="btn btn-primary">Edit</a>

                        <!-- Delete Form -->
                        <form action="{{ route('products.destroy', ['product' => $product->id]) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')" style="color: #1a202c">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
