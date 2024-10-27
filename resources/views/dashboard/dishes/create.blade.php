@extends('layouts.dashboard')

@section('content')
<div class="content">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="title-1">Add New Dish</h2>
            <a href="{{ route('dishes.dashboard.index') }}">
                <button type="button" class="btn btn-primary">
                    <i class="zmdi zmdi-plus"></i> Back
                </button>
            </a>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('dishes.dashboard.store') }}" method="POST">
                    @csrf
                    <!-- Dish Title -->
                    <div class="form-group">
                        <label for="dish_title">Dish Title</label>
                        <input type="text" name="dish_title" id="dish_title" class="form-control"
                            value="{{ old('dish_title') }}" required>
                        @error('dish_title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Dish Description -->
                    <div class="form-group">
                        <label for="dish_description">Dish Description</label>
                        <textarea name="dish_description" id="dish_description" class="form-control"
                            required>{{ old('dish_description') }}</textarea>
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
                                <option value="{{ $id }}" {{ old('dish_category_id') == $id ? 'selected' : '' }}>
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
                                <option value="{{ $chef->chef_id }}" {{ old('chef_id') == $chef->chef_id ? 'selected' : '' }}>
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
                        <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}"
                            required step="0.01" min="0">
                        @error('price')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Create Dish</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection