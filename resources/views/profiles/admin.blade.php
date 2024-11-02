@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Admin Profile</h2>
    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $user->id }}</p>
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Role:</strong> Admin</p>
        </div>
    </div>
</div>
@endsection
