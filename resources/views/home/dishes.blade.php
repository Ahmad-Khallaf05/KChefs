@extends('layouts.home')

@section('content')
<style>
    .card-item {
        background-color: #fff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        text-align: center;
        margin: 15px 0;
        position: relative;
        /* Required for ::after positioning */
    }

    .card-item::after {
        content: "";
        /* Ensures it displays */
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.1);
        /* Semi-transparent overlay */
        transition: opacity 0.2s ease;
        opacity: 0;
        /* Hidden by default */
        z-index: 1;
        border-radius: 8px;
    }

    .card-item:hover::after {
        opacity: 1;
        /* Makes overlay visible on hover */
    }

    .card-item a {
        position: relative;
        z-index: 2;
        /* Ensures content is above ::after overlay */
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
                <button type="submit" class="btn btn-black filter-button">Filter</button>
            </div>
        </form>
    </div>

    <!-- Dishes List with Styled Cards -->
    <div class="container">
        <div class="row gy-4">
            @forelse($dishes as $dish)
                <div class="col-lg-4 col-md-6">
                    <div class="card-item">
                        <a href="{{ route('dishes.show', $dish->dish_id) }}" class="stretched-link">
                        <div class="col-md-6">
                        <div class="image-container">
                            @if($dish->images->isNotEmpty())
                                <img src="{{ asset($dish->images->first()->image_path) }}" alt="{{ $dish->dish_title }}" class="img-fluid" style="max-height: 400px; object-fit: cover;">
                            @else
                                <p>No image available</p>
                            @endif
                        </div>
                    </div>


                            <div class="card-content">
                                <h4 class="dish-title">{{ $dish->dish_title }}</h4>
                                <p class="dish-description">{{ Str::limit($dish->dish_description, 100) }}</p>
                            </div>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center">No dishes found.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $dishes->appends(request()->query())->links() }}
    </div>
</section>
@endsection