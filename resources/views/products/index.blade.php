@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
@endpush

@section('content')
    <div class="users-nav">
        <a href="{{ route('products.create') }}" class="btn bg-success text-light p-2 m-2">Create product</a>
        <div class="dropdown">
            <button class="btn bg-primary text-light dropdown-toggle p-2 m-2" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                Filter by type
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="{{ route('products.index') }}">All</a></li>
                <li><hr class="dropdown-divider"></li>
                @foreach($types as $type)
                    <li><a class="dropdown-item" href="{{ route('products.byType', ['type' => $type->id]) }}">{{ $type->name }}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="dropdown">
            <button class="btn bg-primary text-light dropdown-toggle p-2 m-2" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                Filter by category
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="{{ route('products.index') }}">All</a></li>
                <li><hr class="dropdown-divider"></li>
                @foreach($categories as $category)
                    <li><a class="dropdown-item" href="{{ route('products.byCategory', ['category' => $category->id]) }}">{{ $category->name }}</a></li>
                @endforeach
            </ul>
        </div>

        <form class="d-flex m-2 align-self-end" role="search" action="{{ route("products.search") }}" method="post">
            @csrf
            <input class="form-control border border-success rounded me-2" name="search" type="search" placeholder="Search by name" aria-label="Search" value="{{ old('search') }}">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>

        <a href="{{ route('download.products') }}" class="btn btn-dark p-2 m-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-file-earmark-arrow-down-fill" viewBox="0 0 16 16">
                <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1m-1 4v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V7.5a.5.5 0 0 1 1 0"/>
            </svg>
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="table-auto w-full bg-white shadow-md rounded-lg">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-2 text-left"> # </th>
                <th class="px-4 py-2 text-left"> Name </th>
                <th class="px-4 py-2 text-left"> Type </th>
                <th class="px-4 py-2 text-left"> Category </th>
                <th class="px-4 py-2 text-left"> Price </th>
                <th class="px-4 py-2 text-left"> Quantity </th>
                <th class="px-4 py-2 text-left"> Importation Date </th>
                <th class="px-4 py-2 text-left"> Expiration Date </th>
                <th class="px-4 py-2 text-left">Actions</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
            @foreach($products as $product)
                <tr>
                    <td class="px-4 py-2">{{ $product->id }}</td>
                    <td class="px-4 py-2">{{ $product->name }}</td>
                    <td class="px-4 py-2">{{ $product->type->name }}</td>
                    <td class="px-4 py-2">{{ $product->category->name }}</td>
                    <td class="px-4 py-2">{{ $product->price }}</td>
                    <livewire:product-quantity :currentQuantity="$product->quantity" :id="$product->id" />
                    <td class="px-4 py-2">{{ $product->importation_date }}</td>
                    <td class="px-4 py-2">{{ $product->expiration_date }}</td>
                    <td>
                        <button class="btn btn-outline-primary">
                            <a href="{{ route("products.show",['product' => $product->id]) }}">
                                Show
                            </a>
                        </button>
                        <button class="btn btn-outline-warning">
                            <a href="{{ route("products.edit",['product' => $product->id]) }}">
                                Edit
                            </a>
                        </button>
                        <form action="{{ route('products.destroy', ['product' => $product->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger font-bold py-2 px-4 rounded ml-2">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
