@extends('layouts.dashboard')

@section('content')
<div class="content">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="title-1">Dishes</h2>
            <a href="{{ route('dishes.dashboard.create') }}">
                <button type="button" class="btn btn-primary btn-sm">
                    <i class="zmdi zmdi-plus"></i> Add New Dish
                </button>
            </a>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    {{-- Filter by Category --}}
                    <form method="GET" action="{{ route('dishes.dashboard.index') }}" class="d-flex align-items-center">
                        <div class="form-group mb-0">
                            <select name="category" class="form-control form-control-sm" style="border-radius: 10px; padding: 5px 10px;">
                                <option value="">All Categories</option>
                                @foreach($categories as $id => $category)
                                    <option value="{{ $id }}" {{ request('category') == $id ? 'selected' : '' }}>
                                        {{ ucfirst($category->dish_category_name) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-secondary btn-sm ml-2" style="border-radius: 10px;">Filter</button>
                    </form>

                    {{-- Combined Search by Name, Description, or Chef Username --}}
                    <form method="GET" action="{{ route('dishes.dashboard.index') }}" class="d-flex align-items-center">
                        <input type="text" name="search" class="form-control form-control-sm" placeholder="Search by name, description, or chef username" value="{{ request('search') }}" style="border-radius: 10px; padding: 5px 10px;">
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
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Category</th>
                                <th scope="col">Chef Name</th> <!-- Updated to Chef Name -->
                                <th scope="col">Price</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dishes as $dish)
                                <tr>
                                    <td>{{ $dish->dish_id }}</td>
                                    <td>{{ $dish->dish_title }}</td>
                                    <td>{{ $dish->category->dish_category_name ?? 'N/A' }}</td>
                                    <td>{{ $dish->chef->username ?? 'N/A' }}</td> 
                                    <td>{{ number_format($dish->price, 2) }}</td>
                                    <td>
                                        <a href="{{ route('dishes.dashboard.show', $dish) }}" class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('dishes.dashboard.edit', $dish) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <button class="btn btn-danger btn-sm" onclick="confirmDelete('{{ route('dishes.dashboard.destroy', $dish) }}')">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Pagination links --}}
            <div class="card-footer">
                {{ $dishes->appends(request()->query())->links() }}
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
