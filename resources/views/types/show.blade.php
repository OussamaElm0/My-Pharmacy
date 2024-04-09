@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $type->name }}</div>

                    <div class="card-body">
                        <p><strong>ID:</strong> {{ $type->id }}</p>
                        <p><strong>Name:</strong> {{ $type->name }}</p>

                        <a href="{{ route('types.edit', ['type' => $type->id]) }}" class="btn btn-primary">Edit</a>

                        <!-- Delete Form -->
                        <form action="{{ route('types.destroy', ['type' => $type->id]) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this type?')" style="color: #1a202c">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
