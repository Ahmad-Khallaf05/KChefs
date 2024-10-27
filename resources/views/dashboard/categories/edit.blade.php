@extends('layouts.dashboard')

@section('content')
<div class="content">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="title-1">Edit Category</h2>
            <a href="{{ route('categories.dashboard.index') }}">
                <button type="button" class="btn btn-primary">
                    <i class="zmdi zmdi-plus"></i> Back to Categories
                </button>
            </a>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Edit Category Details</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('categories.dashboard.update', $category) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Category Name -->
                    <div class="form-group">
                        <label for="dish_category_name">Category Name</label>
                        <input type="text" name="dish_category_name" id="dish_category_name" class="form-control"
                            value="{{ old('dish_category_name', $category->dish_category_name) }}" required>
                        @error('dish_category_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Category Image -->
                    <div class="form-group">
                        <label for="image">Category Image</label>
                        <input type="file" name="image" id="image" class="form-control-file">
                        @if($category->image_path)
                            <div class="mt-3">
                                <img src="{{ asset('storage/' . $category->image_path) }}" alt="Category Image" class="img-thumbnail" width="150">
                            </div>
                        @endif
                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Update Category</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
