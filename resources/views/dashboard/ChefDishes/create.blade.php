@extends('layouts.dashboard')

@section('content')
<div class="content">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="title-1">Add New Dish</h2>
            <a href="{{ route('ChefDishes.dashboard.index') }}">
                <button type="button" class="btn btn-secondary btn-sm">
                    <i class="zmdi zmdi-arrow-left"></i> Back to Dishes
                </button>
            </a>
        </div>

        <div class="card">
            <div class="card-header">Create a New Dish</div>

            <div class="card-body">
                {{-- Validation errors --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Create Form --}}
                <form method="POST" action="{{ route('ChefDishes.dashboard.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="dish_title">Dish Name</label>
                        <input type="text" name="dish_title" id="dish_title" class="form-control" value="{{ old('dish_title') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select name="category_id" id="category_id" class="form-control" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ ucfirst($category->dish_category_name) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="chef_id">Chef</label>
                        <select name="chef_id" id="chef_id" class="form-control" required>
                            <option value="">Select Chef</option>
                            @foreach($chefs as $chef)
                                <option value="{{ $chef->id }}" {{ old('chef_id') == $chef->id ? 'selected' : '' }}>
                                    {{ ucfirst($chef->username) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="5">{{ old('description') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Create Dish</button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
