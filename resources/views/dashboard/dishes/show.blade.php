@extends('layouts.dashboard')

@section('content')
<div class="content">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="title-1">Show Dish</h2>
            <a href="{{ route('dishes.dashboard.index') }}">
                <button type="button" class="btn btn-primary">
                    <i class="zmdi zmdi-plus"></i> Dishes
                </button>
            </a>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>Dish Details</h3>
            </div>
            <div class="card-body">
                <!-- Dish Title -->
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Dish Title:</strong></div>
                    <div class="col-md-8">{{ $dish->dishe_title }}</div>
                </div>

                <!-- Dish Description -->
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Description:</strong></div>
                    <div class="col-md-8">{{ $dish->dishe_description }}</div>
                </div>

                <!-- Price -->
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Price:</strong></div>
                    <div class="col-md-8">${{ number_format($dish->price, 2) }}</div>
                </div>

                <!-- Category -->
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Category:</strong></div>
                    <div class="col-md-8">{{ $dish->category->category_name ?? 'N/A' }}</div>
                </div>

                <!-- Chef Name -->
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Chef:</strong></div>
                    <div class="col-md-8">{{ $dish->chef->username ?? 'N/A' }}</div>
                </div>

                <!-- Dish Image (if applicable) -->
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Dish Image:</strong></div>
                    <div class="col-md-8">
                        @if($dish->dish_image)
                            <img src="{{ asset('storage/' . $dish->dish_image) }}" alt="Dish Image"
                                class="img-thumbnail" width="150">
                        @else
                            <p>No Image Available</p>
                        @endif
                    </div>
                </div>

                <!-- Edit Button -->
                <div class="row">
                    <div class="col-md-12 text-right">
                        <a href="{{ route('dishes.dashboard.edit', $dish) }}" class="btn btn-primary">Edit Dish</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
