@extends('layouts.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/users.css') }}">
@endpush
@section('content')
    <div class="users-nav">
        <a href="{{ route('register') }}" class="btn bg-success text-light p-2 m-2">Create user</a>
        <div class="dropdown">
            <button class="btn bg-primary text-light dropdown-toggle p-2 m-2" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                Filter by role
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="{{ route('users.index') }}">All</a></li>
                <li><hr class="dropdown-divider"></li>
                @foreach($roles as $role)
                    <li><a class="dropdown-item" href="{{ route('users.byRole', ['role' => $role->id]) }}">{{ $role->name }}</a></li>
                @endforeach
            </ul>
        </div>
        <form class="d-flex m-2 align-self-end" role="search" action="{{ route("users.search") }}" method="post">
            @csrf
            <input class="form-control border border-success rounded me-2" name="search" type="search" placeholder="Search" aria-label="Search" value="{{ old('search') }}">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        <a href="{{ route('download.users') }}" class="btn btn-warning">Download users report</a>
    </div>
    <div class="overflow-x-auto">
        <table class="table-auto w-full bg-white shadow-md rounded-lg">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-2 text-left"> # </th>
                <th class="px-4 py-2 text-left"> Name </th>
                <th class="px-4 py-2 text-left"> Email </th>
                <th class="px-4 py-2 text-left"> Role </th>
                <th class="px-4 py-2 text-left"> Actions </th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
            @foreach($users as $user)
                <tr>
                    <td class="px-4 py-2">{{ $user->id }}</td>
                    <td class="px-4 py-2">{{ $user->name }}</td>
                    <td class="px-4 py-2">{{ $user->email }}</td>
                    <td class="px-4 py-2">{{ $user->role->name }}</td>
                    <td class="px-4 py-2">
                        <div class="flex">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                <a href="{{ route('users.show', ['user' => $user]) }}" style="text-decoration: none; color: #4fef15;">Show</a>
                            </button>
                            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded ml-2">
                                <a href="{{ route("users.edit", ["user" => $user->id]) }}" style="text-decoration: none; color: #0c4ae8;">Update</a>
                            </button>
                            <form action="{{ route('users.destroy', ['user' => $user]) }}" method="post">
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
        {{ $users->links() }}
    </div>
@endsection
