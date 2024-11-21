@extends('layouts.dashboard')

@section('content')
<div class="content">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="title-1">Show User</h2>
            <a href="{{ route('users.dashboard.index') }}">
                <button type="button" class="btn btn-primary">
                    <i class="zmdi zmdi-plus"></i> Users
                </button>
            </a>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>User Profile</h3>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Profile Picture:</strong></div>
                    <div class="col-md-8">
                        @if($user->profile_picture)
                            <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture"
                                class="img-thumbnail" width="150">
                        @else
                            <p>No Profile Picture</p>
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4"><strong>Username:</strong></div>
                    <div class="col-md-8">{{ $user->username }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4"><strong>First Name:</strong></div>
                    <div class="col-md-8">{{ $user->first_name }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4"><strong>Last Name:</strong></div>
                    <div class="col-md-8">{{ $user->last_name }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4"><strong>Email:</strong></div>
                    <div class="col-md-8">{{ $user->email }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4"><strong>Role:</strong></div>
                    <div class="col-md-8">{{ ucfirst($user->role) }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4"><strong>Phone:</strong></div>
                    <div class="col-md-8">{{ $user->phone ?? 'N/A' }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4"><strong>Bio:</strong></div>
                    <div class="col-md-8">{{ $user->bio ?? 'N/A' }}</div>
                </div>

                <!-- Edit Button -->
                <div class="row">
                    <div class="col-md-12 text-right">
                        <a href="{{ route('users.dashboard.edit', $user) }}" class="btn btn-primary">Edit User</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection