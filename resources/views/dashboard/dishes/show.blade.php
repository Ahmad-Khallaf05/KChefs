@extends('layouts.dashboard')

@section('content')
<div class="content">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="title-1">Show Dish</h2>
            <a href="{{ route('dishes.dashboard.index') }}">
                <button type="button" class="btn btn-primary">
                    <i class="zmdi zmdi-plus"></i> Back to Dishes
                </button>
            </a>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>Dish Details</h3>
            </div>

            <div class="card-body">
                <!-- Dish Image (Primary Image) -->
                <div class="row mb-4">
                    <div class="col-md-12 text-center">
                        @if($dish->primaryImage)
                            <img src="{{ asset('storage/' . $dish->primaryImage->image_path) }}" alt="Primary Dish Image"
                                class="img-fluid img-thumbnail" style="max-width: 400px;">
                        @else
                            <p>No Image Available</p>
                        @endif
                    </div>
                </div>

                <!-- Additional Images -->
                @if($dish->images && $dish->images->count() > 0)
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h4>Additional Images:</h4>
                            <div class="d-flex flex-wrap">
                                @foreach($dish->images as $image)
                                    <div class="mr-2 mb-2">
                                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="Dish Image"
                                            class="img-thumbnail" style="max-width: 150px;">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Dish Title -->
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Dish Title:</strong></div>
                    <div class="col-md-8">{{ $dish->dish_title }}</div>
                </div>

                <!-- Dish Description -->
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Description:</strong></div>
                    <div class="col-md-8">{{ $dish->dish_description }}</div>
                </div>

                <!-- Price -->
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Price:</strong></div>
                    <div class="col-md-8">${{ number_format($dish->price, 2) }}</div>
                </div>

                <!-- Category -->
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Category:</strong></div>
                    <div class="col-md-8">{{ $dish->category->dish_category_name ?? 'N/A' }}</div>
                </div>

                <!-- Chef Name -->
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Chef:</strong></div>
                    <div class="col-md-8">{{ $dish->chef->username ?? 'N/A' }}</div>
                </div>

                <!-- Ingredients (optional if available) -->
                @if($dish->ingredients)
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Ingredients:</strong></div>
                        <div class="col-md-8">{{ $dish->ingredients }}</div>
                    </div>
                @endif

                <!-- Ratings (optional if available) -->
                @if($dish->ratings)
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Rating:</strong></div>
                        <div class="col-md-8">
                            @for ($i = 0; $i < $dish->ratings; $i++)
                                <i class="zmdi zmdi-star" style="color: gold;"></i>
                            @endfor
                        </div>
                    </div>
                @endif

                <!-- Edit and Delete Buttons -->
                <div class="row">
                    <div class="col-md-12 text-right">
                        <a href="{{ route('dishes.dashboard.edit', $dish) }}" class="btn btn-primary">Edit Dish</a>
                        <button class="btn btn-danger"
                            onclick="confirmDelete('{{ route('dishes.dashboard.destroy', $dish) }}')">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(deleteUrl) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
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
