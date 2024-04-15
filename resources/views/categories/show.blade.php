@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $category->name }}</div>

                    <div class="card-body">
                        <p><strong>ID:</strong> {{ $category->id }}</p>
                        <p><strong>Name:</strong> {{ $category->name }}</p>
                        <p><strong>Total products:</strong> {{ count($category->products()->get()) }}</p>

                        <a href="{{ route('categories.edit', ['category' => $category->id]) }}" class="btn btn-primary">Edit</a>

                        <!-- Delete Form -->
                        <form action="{{ route('categories.destroy', ['category' => $category->id]) }}" method="POST"
                              style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button category="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this category?')"
                                    style="color: #1a202c">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
