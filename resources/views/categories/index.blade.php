@extends('layouts.app')

@section('content')
    @if(session('success'))
        <div class="alert alert-success mt-1" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <a href="{{ route('categories.create') }}" class="btn bg-success text-light p-2 m-2">Create</a>
    <table class="table-auto w-full bg-white shadow-md rounded-lg">
        <thead class="bg-gray-50">
        <tr>
            <th class="px-4 py-2 text-left"> # </th>
            <th class="px-4 py-2 text-left"> Name </th>
            <th class="px-4 py-2 text-left"> Total products </th>
            <th class="px-4 py-2 text-left">Actions</th>
        </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
        @foreach($categories as $category)
            <tr>
                <td class="px-4 py-2">{{ $category->id }}</td>
                <td class="px-4 py-2">{{ $category->name }}</td>
                <td class="px-4 py-2">{{ count($category->products()->get()) }}</td>
                <td class="px-4 py-2 flex gap-4">
                    <a class="btn btn-outline-primary" href="{{ route('categories.show', ['category' => $category->id]) }}">
                        Show
                    </a>
                    <a class="btn btn-outline-warning" href="{{ route('categories.edit', ['category' => $category->id]) }}">
                        Edit
                    </a>
                    <form method="post" action="{{ route('categories.destroy', ['category' => $category->id]) }}">
                        @csrf
                        @method('DELETE')
                        <button category="submit" class="btn btn-outline-danger">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
