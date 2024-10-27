@extends('layouts.home')

@section('content')
<br>
<br>
<br>
<br>

<!-- Dishes Section -->
<section id="our-dishes" class="our-dishes section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>OUR DISHES</h2>
        <p>Explore our delicious dishes.</p>
    </div><!-- End Section Title -->

    <style>
        .card-item {
            background-color: #191815; /* Background color */
            border: 2px solid #000; /* Border color and width */
            border-radius: 10px; /* Rounding the corners */
            padding: 10px; /* Space between the border and content */
            position: relative; /* Positioning for the link */
            overflow: hidden; /* Ensures the image doesn't overflow */
            transition: transform 0.2s, box-shadow 0.2s, background-color 0.2s; /* Animation for scaling, shadow, and background color */
        }

        .card-item a {
            text-decoration: none; /* Remove underline */
            color: #fff; /* Text color */
            display: block; /* Makes the anchor fill the card */
            height: 100%; /* Ensures the anchor fills the card */
        }

        .card-item:hover {
            transform: scale(1.05); /* Slightly enlarge the card on hover */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* Adds shadow on hover */
            background-color: #cda45e; /* Change background color on hover */
        }

        .search-filter-form {
            margin-bottom: 20px;
        }

        .search-input,
        .category-select,
        .chef-select {
            font-size: 14px;
            color: #000; /* Black color */
            border: 1px solid #000; /* Black border */
            height: 35px; /* Smaller height */
        }

        .filter-button {
            background-color: #000; /* Black button */
            color: #fff;
            padding: 6px 12px; /* Smaller button size */
            border: none;
            font-size: 14px;
        }

        .filter-button:hover {
            background-color: #333; /* Slightly lighter black on hover */
        }
    </style>

    <!-- Search and Filter Form -->
    <div class="container">
        <form action="{{ route('dishes') }}" method="GET" class="row gy-2 search-filter-form">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control search-input" placeholder="Search by Dish Title..."
                       value="{{ request()->get('search') }}">
            </div>
            <div class="col-md-4">
                <select name="category" class="form-select category-select">
                    <option value="">Select Category</option>
                    @foreach($categories as $categoryId => $categoryName)
                        <option value="{{ $categoryId }}" {{ request()->get('category') == $categoryId ? 'selected' : '' }}>
                            {{ $categoryName }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <select name="chef" class="form-select chef-select">
                    <option value="">Select Chef</option>
                    @foreach($chefs as $chef)
                        <option value="{{ $chef->id }}" {{ request()->get('chef') == $chef->id ? 'selected' : '' }}>
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

    <!-- Dishes List -->
    <div class="container">
        <div class="row gy-4">
            @forelse($dishes as $dish)
                <div class="col-lg-4">
                    <div class="card-item">
                        <a href="{{ route('dishes.show', $dish->dish_id) }}" class="stretched-link">
                            <img src="{{ $dish->primaryImage ? asset('storage/' . $dish->primaryImage->image_path) : asset('./assets/home/img/dishes/dish-1.jpg') }}" 
                                 alt="{{ $dish->dish_title }}" class="img-fluid rounded mb-3" 
                                 style="width: 100%; height: 250px; object-fit: cover;">
                            <h4>{{ $dish->dish_title }}</h4>
                            <p>{{ Str::limit($dish->dish_description, 100) }}</p>
                        </a>
                    </div>
                </div><!-- Card Item -->
            @empty
                <div class="col-12">
                    <p class="text-center">No dishes found.</p>
                </div>
            @endforelse
        </div>
    </div><!-- End Dishes List -->

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $dishes->appends(request()->query())->links() }} <!-- Keeps filters and searches during pagination -->
    </div>

</section><!-- End Our Dishes Section -->
@endsection
