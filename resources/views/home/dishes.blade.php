@extends('layouts.home')

@section('content')
<style>
    .card-item {
        background-color: #191815;
        border: 2px solid #000; 
        border-radius: 10px;
        padding: 15px; /* Increased padding */
        position: relative; 
        overflow: hidden; 
        transition: transform 0.2s, box-shadow 0.2s, background-color 0.2s; 
    }

    .card-item a {
        text-decoration: none; 
        color: #fff; 
        display: block; 
        height: 100%; 
        transition: color 0.2s; 
    }

    .card-item:hover {
        transform: scale(1.05); 
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.3); /* Enhanced shadow */
        background-color: #cda45e; 
    }

    .card-item:hover h2,
    .card-item:hover p {
        color: #000;
    }

    /* New styles for image */
    .card-image {
        width: 100%; 
        height: 300px; /* Increased height */
        object-fit: cover; /* Maintain aspect ratio */
        border-radius: 10px; /* Match card border radius */
    }

    .section-title h2 {
        margin-bottom: 10px; /* Space below titles */
    }

    /* Adjusting text styles */
    .card-item h2 {
        font-size: 1.5rem; /* Increased font size */
        margin: 10px 0; /* Space around titles */
    }

    .card-item p {
        font-size: 1.1rem; /* Increased font size */
    }
</style>
<br>
<br>
<br>
<section id="our-dishes" class="our-dishes section">
    <div class="container section-title">
        <h2>OUR DISHES</h2>
        <p>Explore our delicious dishes.</p>
    </div>

    <!-- Search and Filter Form -->
    <div class="container">
        <form action="{{ route('dishes.index') }}" method="GET" class="row gy-2 search-filter-form">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control search-input" placeholder="Search by Dish Title..."
                    value="{{ request()->get('search') }}">
            </div>
            <div class="col-md-4">
                <select name="category" class="form-select category-select">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->dish_category_id }}" {{ request()->get('category') == $category->dish_category_id ? 'selected' : '' }}>
                            {{ $category->dish_category_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <select name="chef" class="form-select chef-select">
                    <option value="">Select Chef</option>
                    @foreach($chefs as $chef)
                        <option value="{{ $chef->chef_id }}" {{ request()->get('chef') == $chef->chef_id ? 'selected' : '' }}>
                            {{ $chef->username }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-warning filter-button" >Filter</button>
            </div>
        </form>
    </div>

    <br>

  <!-- Dishes Cards -->
<div class="container">
    <div class="row gy-4">
        @foreach($dishes as $dish)
            <div class="col-lg-4">
                <div class="card-item">
                    <a href="{{ route('dishes.show', $dish->dish_id) }}" class="stretched-link">
                        <img src="{{ asset($dish->images->first()->image_path ?? 'default.jpg') }}" 
                             alt="{{ $dish->dish_title }}" 
                             class="img-fluid card-image">
                        <h2>{{ $dish->dish_title }}</h2>
                        <p><strong>Price:</strong> ${{ number_format($dish->price, 2) }}</p>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $dishes->appends(request()->query())->links() }}
    </div>
</section>
@endsection