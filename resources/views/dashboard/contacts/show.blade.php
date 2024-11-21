@extends('layouts.dashboard')

@section('content')
<div class="content">
    <div class="container">

        <div class="card">
            <div class="card-header">
                <h3>Contact Details</h3>
            </div>
            <div class="card-body">
                <p><strong>ID:</strong> {{ $contact->id }}</p>
                <p><strong>Name:</strong> {{ $contact->user_name }}</p>
                <p><strong>Email:</strong> {{ $contact->user_email }}</p>
                <p><strong>Subject:</strong> {{ $contact->subject }}</p>
                <p><strong>Message:</strong></p>
                <p>{{ $contact->message }}</p>

                <a href="{{ route('contacts.dashboard.index') }}" class="btn btn-primary">Back to List</a>
            </div>
        </div>

    </div>
</div>
@endsection
