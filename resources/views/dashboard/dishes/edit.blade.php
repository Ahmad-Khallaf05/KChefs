@extends('layouts.dashboard')

@section('content')
<div class="content">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="title-1">Edit Dish</h2>
            <a href="{{ route('dishes.dashboard.index') }}">
                <button type="button" class="btn btn-primary">
                    <i class="zmdi zmdi-plus"></i> Dishes
                </button>
            </a>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Edit Dish Details</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('dishes.dashboard.update', $dish) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Dish Title -->
                    <div class="form-group">
                        <label for="dish_title">Dish Title</label>
                        <input type="text" name="dish_title" id="dish_title" class="form-control"
                            value="{{ old('dish_title', $dish->dish_title) }}" required>
                        @error('dish_title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Dish Description -->
                    <div class="form-group">
                        <label for="dish_description">Dish Description</label>
                        <textarea name="dish_description" id="dish_description" class="form-control" required>{{ old('dish_description', $dish->dish_description) }}</textarea>
                        @error('dish_description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Category Selection -->
                    <div class="form-group">
                        <label for="dish_category_id">Category</label>
                        <select name="dish_category_id" id="dish_category_id" class="form-control" required>
                            <option value="">Select a category</option>
                            @foreach($categories as $id => $name)
                                <option value="{{ $id }}" {{ old('dish_category_id', $dish->dish_category_id) == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                        @error('dish_category_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Chef Selection -->
                    <div class="form-group">
                        <label for="chef_id">Chef</label>
                        <select name="chef_id" id="chef_id" class="form-control" required>
                            <option value="">Select a chef</option>
                            @foreach($chefs as $chef)
                                <option value="{{ $chef->chef_id }}" {{ old('chef_id', $dish->chef_id) == $chef->chef_id ? 'selected' : '' }}>
                                    {{ $chef->username }}
                                </option>
                            @endforeach
                        </select>
                        @error('chef_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" name="price" id="price" step="0.01" class="form-control"
                            value="{{ old('price', $dish->price) }}" required>
                        @error('price')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Image Upload -->
                    <div class="form-group">
                        <label for="images">Upload Images</label>
                        <input type="file" name="images[]" id="images" class="form-control" multiple>
                        @error('images.*')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Current Images -->
                    <div class="form-group">
                        <label>Current Images</label><br>
                        <div class="form-group mb-3">
                            <img id="main-image" src="{{ asset(json_decode($dish->images)[0] ?? '') }}" alt="Dish Image" class="img-fluid mb-3" style="max-height: 400px; object-fit: cover;">
                        </div>
                        <div class="d-flex flex-wrap">
                            @if(isset($dish->images))
                                @foreach(json_decode($dish->images) as $image)
                                    <div class="m-2">
                                        <img src="{{ asset($image) }}" alt="Dish Image" class="img-thumbnail" style="max-height: 100px; cursor: pointer;" onclick="changeImage('{{ asset($image) }}')">
                                    </div>
                                @endforeach
                            @else
                                <p>No images available.</p>
                            @endif
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Update Dish</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function changeImage(imageUrl) {
        document.getElementById('main-image').src = imageUrl;
    }
</script>

@endsection
