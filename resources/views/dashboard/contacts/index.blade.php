@extends('layouts.dashboard')

@section('content')
<div class="content">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="title-1">Contact Messages</h2>
        </div>

        <div class="card">
            <div class="card-body">
                {{-- Success message --}}
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Table --}}
                <div class="table-responsive">
                    <table class="table-hover table-bordered table">
                        <thead class="table-active">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Message</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($contacts as $contact)
                                <tr>
                                    <td>{{ $contact->id }}</td>
                                    <td>{{ $contact->user_name }}</td>
                                    <td>{{ $contact->user_email }}</td>
                                    <td>{{ $contact->subject }}</td>
                                    <td>{{ Str::limit($contact->message, 50) }}</td>
                                    <td>
                                        <a href="{{ route('contacts.dashboard.show', $contact->id) }}" 
                                           class="btn btn-info btn-sm">View</a>
                                        <form action="{{ route('contacts.dashboard.destroy', $contact->id) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this contact?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No contacts found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
