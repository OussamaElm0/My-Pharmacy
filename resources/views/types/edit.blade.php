@extends('layouts.app')

@section('content')
    <div class="container m-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit type</div>

                    <div class="card-body">
                        <form action="{{ route('types.update', ['type' => $type->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <!-- Name -->
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name"
                                       class="form-control rounded" value="{{ old('name', $type->name) }}">
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
