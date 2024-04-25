@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $pharmacy->name }}</div>

                    <div class="card-body">
                        <p><strong>ID:</strong> {{ $pharmacy->id }}</p>
                        <p><strong>Inpe:</strong> {{ $pharmacy->INPE }}</p>
                        <p><strong>Nombre d'utilisateurs:</strong> {{ count($pharmacy->users()->get()) }}</p>

                        <a href="{{ route('pharmacies.edit', ['pharmacy' => $pharmacy->id]) }}" class="btn btn-primary">Edit</a>

                        <!-- Delete Form -->
                        <form action="{{ route('pharmacies.destroy', ['pharmacy' => $pharmacy->id]) }}" method="POST"
                              style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button pharmacy="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this pharmacy?')"
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
