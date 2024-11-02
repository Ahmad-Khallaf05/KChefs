@extends('layouts.dashboard')

@section('content')
<div class="content">
    <div class="container">
        <h2 class="title-1">Add Chef Specialty</h2>
        <form action="{{ route('chef_specialties.dashboard.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Specialty Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Add Specialty</button>
        </form>
    </div>
</div>
@endsection
