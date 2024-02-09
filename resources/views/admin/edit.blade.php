@extends('layouts.app')

@section('content')
    <div class="container m-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit User</div>

                    <div class="card-body">
                        <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <!-- Name -->
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control rounded" value="{{ old('name', $user->name) }}">
                            </div>

                            <!-- Email -->
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control rounded" value="{{ old('email', $user->email) }}">
                            </div>

                            <!-- Role -->
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select id="role" name="role_id" class="form-control">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ $role->name == $user->role->name ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
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
