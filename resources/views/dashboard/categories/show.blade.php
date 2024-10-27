@extends('layouts.dashboard')

@section('content')
<div class="content">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="title-1">Category Details</h2>
            <a href="{{ route('categories.dashboard.index') }}">
                <button type="button" class="btn btn-primary">
                    <i class="zmdi zmdi-arrow-left"></i> Back to Categories
                </button>
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <!-- Category Image Section -->
                    <div class="col-md-6">
                        @if($category->image_path)
                            <img src="{{ asset('storage/' . $category->image_path) }}" alt="Category Image" class="img-fluid rounded">
                        @else
                            <p class="text-muted">No Image Available</p>
                        @endif
                    </div>

                    <!-- Category Details Section -->
                    <div class="col-md-6">
                        <h3>{{ $category->dish_category_name }}</h3>

                        <!-- Description -->
                        <p class="mt-4"><strong>Description:</strong></p>
                        <p>{{ $category->description ?? 'No description available.' }}</p>

                        <!-- Created At -->
                        <p><strong>Created on:</strong> {{ $category->created_at->format('F d, Y') }}</p>

                        <!-- Updated At -->
                        <p><strong>Last Updated:</strong> {{ $category->updated_at->format('F d, Y') }}</p>

                        <!-- Edit Button -->
                        <a href="{{ route('categories.dashboard.edit', $category) }}" class="btn btn-primary mt-3">
                            <i class="zmdi zmdi-edit"></i> Edit Category
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
