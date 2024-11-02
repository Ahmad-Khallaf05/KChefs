@extends('layouts.dashboard')

@section('content')
<div class="content">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="title-1">Chef Specialty Details</h2>
            <a href="{{ route('chef_specialties.index') }}">
                <button type="button" class="btn btn-primary">
                    <i class="zmdi zmdi-arrow-back"></i> Back
                </button>
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                <h4>Name: {{ $specialty->name }}</h4>
                <form action="{{ route('chef_specialties.destroy', $specialty) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Specialty</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
