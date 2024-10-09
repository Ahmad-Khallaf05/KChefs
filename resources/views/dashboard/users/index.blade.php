@extends('layouts.dashboard')

@section('content')
<div class="content">
    <div class="container">

        
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="title-1">Users</h2>
            <a href="{{ route('users.dashboard.create') }}">
                <button type="button" class="btn btn-primary">
                    <i class="zmdi zmdi-plus"></i> Add New User
                </button>
            </a>
        </div>

        {{-- Success message --}}
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success')}}
        </div>
        @endif

        <table class="table table-striped table-hover table-bordered mt-3">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Role</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        <a href="{{ route('users.dashboard.show', $user) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('users.dashboard.edit', $user) }}" class="btn btn-warning btn-sm">Edit</a>
                        <button class="btn btn-danger btn-sm" onclick="confirmDelete('{{ route('users.dashboard.destroy', $user) }}')">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    function confirmDelete(deleteUrl) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            console.log("Confirmed!");  
            var form = document.createElement('form');
            form.action = deleteUrl;
            form.method = 'POST';

            var csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}';

            var methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';

            form.appendChild(csrfInput);
            form.appendChild(methodInput);
            document.body.appendChild(form);
            form.submit();
        }
    });
}

</script>

@endsection
