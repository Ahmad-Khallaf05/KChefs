@extends('layouts.dashboard')

@section('content')
<div class="content">
    <div class="container">
        <h2 class="title-1">Edit Chef Specialty</h2>
        <form action="{{ route('chef_specialties.dashboard.update', $specialty) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Specialty Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $specialty->name }}" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update Specialty</button>
        </form>
    </div>
</div>
@endsection
