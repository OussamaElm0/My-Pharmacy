@extends('layouts.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
@endpush
@section('content')
    @if(session('success'))
        <div class="alert alert-success mt-1" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="users-nav">
        <a href="{{ route('pharmacies.create') }}" class="btn bg-success text-light p-2 m-2">Create pharmacy</a>
        <div class="dropdown m-2">
            <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Download
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('download.pharmacies', ['format' => 'pdf']) }}">PDF</a></li>
                <li><a class="dropdown-item" href="{{ route('download.pharmacies', ['format' => 'csv']) }}">CSV</a></li>
            </ul>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="table-auto w-full bg-white shadow-md rounded-lg">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-2 text-left"> # </th>
                <th class="px-4 py-2 text-left"> Name </th>
                <th class="px-4 py-2 text-left"> City </th>
                <th class="py-2 px-4 text-left"> Address </th>
                <th class="px-4 py-2 text-left"> Actions </th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
            @foreach($pharmacies as $pharmacy)
                <tr>
                    <td class="px-4 py-2">{{ $pharmacy->id }}</td>
                    <td class="px-4 py-2">{{ $pharmacy->INPE }}</td>
                    @if(!$pharmacy->city)
                        <td class="px-4 py-2 text-danger h6">This data is unavailable</td>
                    @else
                        <td class="px-4 py-2 h6">
                            {{ $pharmacy->city }}
                        </td>
                    @endif
                    @if(!$pharmacy->address)
                        <td class="px-4 py-2 text-danger h6">This data is unavailable</td>
                    @else
                        <td class="px-4 py-2 h6">
                            {{ $pharmacy->address }}
                        </td>
                    @endif
                    <td class="px-4 py-2">
                        <div class="flex">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                <a href="{{ route('pharmacies.show', ['pharmacy' => $pharmacy]) }}" style="text-decoration: none; color: #4fef15;">Show</a>
                            </button>
                            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded ml-2">
                                <a href="{{ route("pharmacies.edit", ["pharmacy" => $pharmacy->id]) }}" style="text-decoration: none; color: #0c4ae8;">Update</a>
                            </button>
                            <form action="{{ route('pharmacies.destroy', ['pharmacy' => $pharmacy]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
