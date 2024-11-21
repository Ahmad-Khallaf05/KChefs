@extends('layouts.home')

@section('content')
<style>
    /* Reuse chef and admin styles */
    .card-item {
        /* Add your reusable styles here */
    }
</style>

<br><br><br><br>
<section id="user-profile" class="user-profile section">
    <div class="container section-title" data-aos="fade-up">
        <h2>User Profile</h2>
        <p>Welcome, {{ $user->name }}</p>
    </div>

    <div class="container">
        <div class="row mb-4">
            <div class="col-md-4">
                <!-- Profile Picture -->
                <img src="{{ asset('storage/'.$user->profile_picture) }}" alt="Profile Picture" class="img-fluid rounded-circle" style="max-width: 150px;">
            </div>
            <div class="col-md-8">
                <h3>{{ $user->first_name }} {{ $user->last_name }}</h3>
                <p><strong>Username:</strong> {{ $user->username }}</p>
                <p><strong>First Name:</strong> {{ $user->first_name }}</p>
                <p><strong>Last Name:</strong> {{ $user->last_name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Phone:</strong> {{ $user->phone ?? 'N/A' }}</p>
                <p><strong>Bio:</strong> {{ $user->bio ?? 'No bio available' }}</p>
                <p><strong>Joined:</strong> {{ $user->created_at->format('F j, Y') }}</p>
            </div>
        </div>
    </div>
</section>
@endsection
