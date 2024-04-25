@extends('layouts.app')

@section('content')
    <div class="container m-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit pharmacy</div>

                    <div class="card-body">
                        <form action="{{ route('pharmacies.update', ['pharmacy' => $pharmacy->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <!-- Name -->
                            <div class="form-group">
                                <label for="inpe">Inpe</label>
                                <input type="text" name="inpe" id="inpe"
                                       class="form-control rounded" value="{{ old('inpe', $pharmacy->INPE) }}">
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
