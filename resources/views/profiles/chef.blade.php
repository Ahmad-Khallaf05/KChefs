@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Chef Profile</h2>
    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $chef->id }}</p>
            <p><strong>Username:</strong> {{ $chef->username }}</p>
            <p><strong>First Name:</strong> {{ $chef->first_name }}</p>
            <p><strong>Last Name:</strong> {{ $chef->last_name }}</p>
            <p><strong>Email:</strong> {{ $chef->email }}</p>
            <p><strong>Specialties:</strong> 
                @foreach($chef->specialties as $specialty)
                    {{ $specialty->name }}{{ !$loop->last ? ', ' : '' }}
                @endforeach
            </p>
        </div>
    </div>
</div>
@endsection
