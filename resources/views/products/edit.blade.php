@extends('layouts.app')

@section('content')
    <div class="container m-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit product</div>

                    <div class="card-body">
                        <form action="{{ route('products.update', ['product' => $product->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <!-- Name -->
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control rounded" value="{{ old('name', $product->name) }}">
                            </div>

                            <!-- Type -->
                            <div class="mt-4">
                                <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Type</label>
                                <select id="type" name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Choose a type</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}" {{ $type->name == $product->type->name ? "selected" : null }}>{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Category -->
                            <div class="mt-4">
                                <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Category</label>
                                <select id="category" name="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Choose a category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->name == $product->category->name ? "selected" : null }}>>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Price -->
                            <div>
                                <x-input-label for="price" :value="__('Price')" />
                                <x-text-input id="price" class="block mt-1 w-full" type="number" min="0" name="price" :value="old('price', $product->price)" required autofocus autocomplete="name" />
                                <x-input-error :messages="$errors->get('price')" class="mt-2" />
                            </div>

                            <!-- Quantity -->
                            <div>
                                <x-input-label for="quantity" :value="__('Quantity')" />
                                <x-text-input id="quantity" class="block mt-1 w-full" type="number" step="1" min="0" name="quantity" :value="old('quantity', $product->quantity)" required autofocus autocomplete="name" />
                                <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                            </div>


                            <!-- Importation Date -->
                            <div class="mt-4">
                                <x-input-label for="importation_date" :value="__('Importation Date')" />

                                <x-text-input id="importation_date" class="block mt-1 w-full"
                                              type="date"
                                              :value="old('importation_date',$product->importation_date)"
                                              name="importation_date" required autocomplete="new-date" />
                                <x-input-error :messages="$errors->get('importation_date')" class="mt-2" />
                            </div>

                            <!-- Expiration Date -->
                            <div class="mt-4">
                                <x-input-label for="expiration_date" :value="__('Expiration Date')" />

                                <x-text-input id="expiration_date" class="block mt-1 w-full"
                                              type="date"
                                              :value="old('expiration_date',$product->expiration_date)"
                                              name="expiration_date" required autocomplete="new-date" />
                                <x-input-error :messages="$errors->get('expiration_date')" class="mt-2" />
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary text-dark m-2 rounded">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
