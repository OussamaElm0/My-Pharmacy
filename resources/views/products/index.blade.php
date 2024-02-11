@extends('layouts.app')

@section('content')
    <a href="{{ route('products.create') }}">Create</a>
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
                    <td class="px-4 py-2">{{ $product->quantity   }}</td>
                    <td class="px-4 py-2">{{ $product->importation_date }}</td>
                    <td class="px-4 py-2">{{ $product->expiration_date }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
