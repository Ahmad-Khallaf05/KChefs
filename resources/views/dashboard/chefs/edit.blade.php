@extends('layouts.dashboard')
@section('content')
<div class="content">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="title-1">Edit User</h2>
            <a href="{{ route('chefs.dashboard.index') }}">
                <button type="button" class="btn btn-primary">
                    <i class="zmdi zmdi-plus"></i> Chefs
                </button>
            </a>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Edit Chef Details</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('chefs.dashboard.update', $chef) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Username -->
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control"
                            value="{{ old('username', $chef->username) }}" required>
                    </div>

                    <!-- First Name -->
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" name="first_name" id="first_name" class="form-control"
                            value="{{ old('first_name', $chef->first_name) }}" required>
                    </div>

                    <!-- Last Name -->
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name" id="last_name" class="form-control"
                            value="{{ old('last_name', $chef->last_name) }}" required>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control"
                            value="{{ old('email', $chef->email) }}" required>
                    </div>

                    <!-- Chef Specialties -->
                    <div class="form-group">
                        <label for="chef_specialties">Chef Specialties</label>
                        <input type="text" name="chef_specialties" id="chef_specialties" class="form-control"
                            value="{{ old('chef_specialties', $chef->chef_specialties) }}" required>
                    </div>

                    <!-- Phone (optional) -->
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control"
                            value="{{ old('phone', $chef->phone) }}">
                    </div>

                    <!-- Bio (optional) -->
                    <div class="form-group">
                        <label for="bio">Bio</label>
                        <textarea name="bio" id="bio" class="form-control" rows="3">{{ old('bio', $chef->bio) }}</textarea>
                    </div>

                    <!-- Profile Picture (optional) -->
                    <div class="form-group">
                        <label for="profile_picture">Profile Picture</label>
                        <input type="file" name="profile_picture" id="profile_picture" class="form-control-file">
                        @if($chef->profile_picture)
                            <div class="mt-3">
                                <img src="{{ asset('storage/' . $chef->profile_picture) }}" alt="Profile Picture" class="img-thumbnail" width="150">
                            </div>
                        @endif
                    </div>

                    <!-- Password (optional) -->
                    <div class="form-group">
                        <label for="password">Password (Leave empty to keep current password)</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Update User</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection