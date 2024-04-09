@extends('layouts.app')

@section('content')
    @if(session('success'))
        <div class="alert alert-success mt-1" role="alert">
            {{ session('success') }}
        </div>
    @endif
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
        @foreach($types as $type)
            <tr>
                <td class="px-4 py-2">{{ $type->id }}</td>
                <td class="px-4 py-2">{{ $type->name }}</td>
                <td class="px-4 py-2">{{ count($type->products()->get()) }}</td>
                <td class="px-4 py-2 flex gap-4">
                    <a class="btn btn-outline-primary" href="{{ route('types.show', ['type' => $type->id]) }}">
                        Show
                    </a>
                    <a class="btn btn-outline-warning" href="{{ route('types.edit', ['type' => $type->id]) }}">
                        Edit
                    </a>
                    <form method="post" action="{{ route('types.destroy', ['type' => $type->id]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
