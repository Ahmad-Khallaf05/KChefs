@extends('layouts.dashboard')
@section('content')
<div class="content">
<div class="container">
<div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="title-1">Add New User</h2>
            <a href="{{ route('users.dashboard.index') }}">
                <button type="button" class="btn btn-primary">
                    <i class="zmdi zmdi-plus"></i> Back
                </button>
            </a>
        </div>
    <form action="{{ route('users.dashboard.store') }}" method="POST">
    @csrf

    <!-- Username -->
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" class="form-control" value="{{ old('username') }}" required>
    </div>

    <!-- First Name -->
    <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name') }}" required>
    </div>

    <!-- Last Name -->
    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name') }}" required>
    </div>

    <!-- Email -->
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
    </div>

    <!-- Password -->
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control" required>
    </div>

    <!-- Role Selection -->
    <div class="form-group">
        <label for="role">Role</label>
        <select name="role" id="role" class="form-control" required>
            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
        </select>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary">Create User</button>
</form>

</div>
</div>
@endsection
