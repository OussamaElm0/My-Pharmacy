@extends('layouts.app')

@section('content')
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
        @foreach($types as $type)

        @endforeach
        </tbody>
    </table>
@endsection
