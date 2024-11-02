@extends('layouts.dashboard')

@section('content')
<div class="content">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="title-1">Chef Specialties</h2>
            <a href="{{ route('chef_specialties.dashboard.create') }}">
                <button type="button" class="btn btn-primary btn-sm">
                    <i class="zmdi zmdi-plus"></i> Add New Specialty
                </button>
            </a>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                  

                    {{-- Search by Name --}}
                    <form method="GET" action="{{ route('chef_specialties.dashboard.index') }}" class="d-flex align-items-center">
                        <input type="text" name="search" class="form-control form-control-sm" placeholder="Search by name" value="{{ request('search') }}" style="border-radius: 10px; padding: 5px 10px;">
                        <button type="submit" class="btn btn-primary btn-sm ml-2" style="border-radius: 10px;">Search</button>
                    </form>
                </div>
            </div>

            <div class="card-body">
                {{-- Success message --}}
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                {{-- Table --}}
                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <table class="table-hover table-bordered mt-3 table">
                        <thead class="table-active">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Specialty Name</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($specialties as $specialty)
                            <tr>
                                <td>{{ $specialty->id }}</td>
                                <td>{{ $specialty->name }}</td>
                                <td>
                                    <a href="{{ route('chef_specialties.dashboard.edit', $specialty) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <button class="btn btn-danger btn-sm" onclick="confirmDelete('{{ route('chef_specialties.dashboard.destroy', $specialty) }}')">Delete</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- Card End --}}

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
