@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
@endpush

@section('content')
    <div class="users-nav">
        <a href="{{ route('products.create') }}" class="btn bg-success text-light p-2 m-2">Create product</a>
        <div class="dropdown">
            <button class="btn bg-primary text-light dropdown-toggle p-2 m-2"
                    type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                    aria-expanded="false">
                Filter by type
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="{{ route('products.index') }}">All</a></li>
                <li><hr class="dropdown-divider"></li>
                @foreach($types as $type)
                    <li>
                        <a class="dropdown-item"
                           href="{{ route('products.byType', ['type' => $type->id]) }}"
                        >{{ $type->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="dropdown">
            <button class="btn bg-primary text-light dropdown-toggle p-2 m-2"
                    type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                    aria-expanded="false">
                Filter by category
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="{{ route('products.index') }}">All</a></li>
                <li><hr class="dropdown-divider"></li>
                @foreach($categories as $category)
                    <li>
                        <a class="dropdown-item"
                           href="{{ route('products.byCategory', ['category' => $category->id]) }}">
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <form class="d-flex m-2 align-self-end" role="search" action="{{ route("products.search") }}" method="post">
            @csrf
            <input class="form-control border border-success rounded me-2" name="search" type="search" placeholder="Search by name" aria-label="Search" value="{{ old('search') }}">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>

        <a href="{{ route('download.products') }}" class="btn btn-dark p-2 m-2">
            <svg xmlns="http://www.w3.org/2000/svg"
                 width="25" height="25" fill="currentColor"
                 class="bi bi-file-earmark-arrow-down-fill" viewBox="0 0 16 16">
                <path
                    d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1m-1 4v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V7.5a.5.5 0 0 1 1 0"
                />
            </svg>
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="table-auto w-full bg-white shadow-md rounded-lg">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-2 text-left"> # </th>
                <th class="px-4 py-2 text-left"> Name </th>
                <th class="px-4 py-2 text-left"> Image </th>
                <th class="px-4 py-2 text-left"> Type </th>
                <th class="px-4 py-2 text-left"> Category </th>
                <th class="px-4 py-2 text-left"> Price </th>
                <livewire:order-quantity />
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
                    <td class="px-4 py-2">
                        <img src="{{ asset('images/products/' . $product->image) }}" width="100"
                             height="100" alt="{{ $product->name }}">
                    </td>
                    <td class="px-4 py-2">{{ $product->type->name }}</td>
                    <td class="px-4 py-2">{{ $product->category->name }}</td>
                    <td class="px-4 py-2">{{ $product->price }}</td>
                    <livewire:product-quantity :currentQuantity="$product->pivot->quantity" :id="$product->id" />
                    <td class="px-4 py-2">{{ $product->importation_date }}</td>
                    <td class="px-4 py-2">{{ $product->expiration_date }}</td>
                    <td class="text-center">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-outline-dark"
                                data-bs-toggle="modal" data-bs-target="#actionsModal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-eye" viewBox="0 0 16 16">
                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                            </svg>
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="actionsModal" tabindex="-1"
                             aria-labelledby="actionsModal" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $product->name }}</h1>
                                        <button type="button" class="btn-close"
                                                data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="{{ asset('images/products/' . $product->image) }}" width="200"
                                             height="200" alt="{{ $product->name }}">
                                        <div class="flex gap-2">
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
                                            <form action="{{ route('products.destroy', ['product' => $product->id]) }}"
                                                  method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-outline-danger font-bold py-2 px-4 rounded ml-2">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $products->links() }}
    </div>
@endsection
