@extends('layouts.dashboard')

@section('content')
<div class="content">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="title-1">Categories</h2>
            <a href="{{ route('categories.dashboard.create') }}">
                <button type="button" class="btn btn-primary btn-sm">
                    <i class="zmdi zmdi-plus"></i> Add New Category
                </button>
            </a>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    {{-- Search by Name --}}
                    <form method="GET" action="{{ route('categories.dashboard.index') }}" class="d-flex align-items-center">
                        <input type="text" name="search" class="form-control form-control-sm" placeholder="Search by category name" value="{{ request('search') }}" style="border-radius: 10px; padding: 5px 10px;">
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
                                <th scope="col">Image</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->dish_category_id }}</td>
                                
                                {{-- Display Image --}}
                                <td>
                                    @if($category->image_path)
                                        <img src="{{ asset('storage/' . $category->image_path) }}" alt="Category Image" style="width: 70px; height: 70px; object-fit: cover;">
                                    @else
                                        <p>No Image</p>
                                    @endif
                                </td>

                                <td>{{ $category->dish_category_name }}</td>
                                <td>{{ $category->description }}</td>
                                <td>
                                    <a href="{{ route('categories.dashboard.show', $category) }}" class="btn btn-info btn-sm">View</a>
                                    <a href="{{ route('categories.dashboard.edit', $category) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <button class="btn btn-danger btn-sm" onclick="confirmDelete('{{ route('categories.dashboard.destroy', $category) }}')">Delete</button>
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
