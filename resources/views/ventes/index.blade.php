@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/ventes.css') }}">
@endpush

@section('content')
    @if(session('success'))
        <div class="alert alert-success mt-1" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="ventes-body">
        <button class="btn btn-outline-success">
            <a href="{{ route('ventes.create') }}">
                Add a sale
            </a>
        </button>
        <button class="btn btn-outline-danger">
            <a href="{{ route('ventes.cancel') }}">
                Cancel a sale
            </a>
        </button>
    </div>
@endsection
