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
                    @if($role->name != "Superuser")
                        <li><a class="dropdown-item" href="{{ route('users.byRole', ['role' => $role->id]) }}">{{ $role->name }}</a></li>
                    @endif
                @endforeach
            </ul>
        </div>
        <form class="d-flex m-2 align-self-end" role="search" action="{{ route("users.search") }}" method="post">
            @csrf
            <input class="form-control border border-success rounded me-2" name="search" type="search" placeholder="Search" aria-label="Search" value="{{ old('search') }}">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        <a href="{{ route('download.users') }}" class="btn btn-dark p-2 m-2">
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
