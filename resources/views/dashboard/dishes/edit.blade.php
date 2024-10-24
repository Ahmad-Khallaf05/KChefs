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
                <form action="{{ route('dishes.dashboard.update', $dish) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Dish Title -->
                    <div class="form-group">
                        <label for="dishe_title">Dish Title</label>
                        <input type="text" name="dishe_title" id="dishe_title" class="form-control"
                            value="{{ old('dishe_title', $dish->dishe_title) }}" required>
                        @error('dishe_title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Dish Description -->
                    <div class="form-group">
                        <label for="dishe_description">Dish Description</label>
                        <textarea name="dishe_description" id="dishe_description" class="form-control" required>{{ old('dishe_description', $dish->dishe_description) }}</textarea>
                        @error('dishe_description')
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
                                <option value="{{ $chef->id }}" {{ old('chef_id', $dish->chef_id) == $chef->id ? 'selected' : '' }}>
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

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Update Dish</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
