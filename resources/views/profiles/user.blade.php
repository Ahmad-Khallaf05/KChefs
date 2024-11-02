@extends('layouts.home')

@section('content')
<style>
    /* Reuse chef and admin styles */
    .card-item { /* Reuse chef card styles */ ... }
</style>

<br><br><br><br>
<section id="user-profile" class="user-profile section">
    <div class="container section-title" data-aos="fade-up">
        <h2>User Profile</h2>
        <p>Welcome, {{ $user->name }}</p>
    </div>

    <div class="container">
        <div class="row mb-4">
            <div class="col-md-8">
                <h3>{{ $user->name }}</h3>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Phone:</strong> {{ $user->phone ?? 'N/A' }}</p>
                <p><strong>Joined:</strong> {{ $user->created_at->format('F j, Y') }}</p>
            </div>
        </div>
    </div>
</section>
@endsection
