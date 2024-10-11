@extends('layouts.dashboard')
@section('content')
<div class="content">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="title-1">Edit User</h2>
            <a href="{{ route('users.dashboard.index') }}">
                <button type="button" class="btn btn-primary">
                    <i class="zmdi zmdi-plus"></i> Users
                </button>
            </a>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Edit User Details</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('users.dashboard.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Username -->
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control"
                            value="{{ old('username', $user->username) }}" required>
                    </div>

                    <!-- First Name -->
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" name="first_name" id="first_name" class="form-control"
                            value="{{ old('first_name', $user->first_name) }}" required>
                    </div>

                    <!-- Last Name -->
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name" id="last_name" class="form-control"
                            value="{{ old('last_name', $user->last_name) }}" required>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control"
                            value="{{ old('email', $user->email) }}" required>
                    </div>

                    <!-- Password (optional) -->
                    <div class="form-group">
                        <label for="password">Password (Leave empty to keep current password)</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>

                    <!-- Role Selection -->
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select name="role" id="role" class="form-control" required>
                            <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Update User</button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
