@extends('layouts.dashboard')

@section('content')
<div class="content">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="title-1">Add New Category</h2>
            <a href="{{ route('categories.dashboard.index') }}">
                <button type="button" class="btn btn-primary">
                    <i class="zmdi zmdi-arrow-back"></i> Back
                </button>
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('categories.dashboard.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @methode('POST')

                    <!-- Category Name -->
                    <div class="form-group">
                        <label for="dish_category_name">Category Name</label>
                        <input type="text" name="dish_category_name" id="dish_category_name" class="form-control"
                            value="{{ old('dish_category_name') }}" required>
                        @error('dish_category_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3"
                            required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    
                    <!-- Image Upload -->
                    <div class="form-group">
                        <label for="image">Category Image</label>
                        <input type="file" name="image" id="image" class="form-control-file">
                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Create Category</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection