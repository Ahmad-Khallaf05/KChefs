@extends('layouts.dashboard')

@section('content')
<div class="content">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="title-1">Dish Details</h2>
            <a href="{{ route('ChefDishes.dashboard.index') }}">
                <button type="button" class="btn btn-secondary btn-sm">
                    <i class="zmdi zmdi-arrow-left"></i> Back to Dishes
                </button>
            </a>
        </div>

        <div class="card">
            <div class="card-header">Dish Details</div>

            <div class="card-body">
                {{-- Dish Information --}}
                <div class="form-group">
                    <strong>Dish Name:</strong>
                    <p>{{ $dish->dish_title }}</p>
                </div>

                <div class="form-group">
                    <strong>Category:</strong>
                    <p>{{ $dish->category->dish_category_name ?? 'N/A' }}</p>
                </div>

                <div class="form-group">
                    <strong>Chef:</strong>
                    <p>{{ $dish->chef->username ?? 'N/A' }}</p>
                </div>

                <div class="form-group">
                    <strong>Price:</strong>
                    <p>{{ number_format($dish->price, 2) }}</p>
                </div>

                <div class="form-group">
                    <strong>Description:</strong>
                    <p>{{ $dish->description }}</p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
