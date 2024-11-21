@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Admin Profile</h2>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <img src="{{ asset('storage/'.$user->profile_picture) }}" alt="Profile Picture" class="img-fluid rounded-circle" style="max-width: 150px;">
                </div>
                <div class="col-md-8">
                    <p><strong>Username:</strong> {{ $user->username }}</p>
                    <p><strong>First Name:</strong> {{ $user->first_name }}</p>
                    <p><strong>Last Name:</strong> {{ $user->last_name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Role:</strong> {{ $user->role }}</p>
                    <p><strong>Phone:</strong> {{ $user->phone }}</p>
                    <p><strong>Bio:</strong> {{ $user->bio }}</p>
                </div>
            </div>
          
        </div>
    </div>
</div>
@endsection
