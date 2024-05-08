@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/ventes.css') }}">
@endpush

@section('content')
    <div class="ventes-body">
        <button class="btn btn-outline-success">
            <a href="{{ route('ventes.create') }}">
                Scan
            </a>
        </button>
        <button class="btn btn-outline-danger">
            <a href="{{ route('ventes.cancel') }}">
                Cancel
            </a>
        </button>
    </div>
@endsection
