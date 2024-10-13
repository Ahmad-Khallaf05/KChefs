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

    <!-- Search and Filter Form -->
    <div class="container">
        <form action="{{ route('dishes') }}" method="GET" class="row gy-2">
            <div class="col-md-6">
                <input type="text" name="search" class="form-control" placeholder="Search Dishes..."
                    value="{{ request()->get('search') }}">
            </div>
            <div class="col-md-4">
                <select name="category" class="form-select">
                    <option value="">Select Category</option>
                    @foreach($categories as $categoryId => $categoryName)
                        <option value="{{ $categoryId }}" {{ request()->get('category') == $categoryId ? 'selected' : '' }}>
                            {{ $categoryName }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </form>
    </div><!-- End Search and Filter Form -->


    <div class="container">
        <div class="row gy-4">
            @foreach($dishes as $index => $dish)
                <div class="col-lg-4">
                    <div class="card-item">
                        <a href="{{ route('dishes', $dish->dish_id) }}" class="stretched-link">
                            <img src="{{ asset('./assets/home/img/dishes/dish-1.jpg') }}" alt="{{ $dish->dishe_title }}"
                                class="img-fluid rounded mb-3" style="width: 100%; height: 250px; object-fit: cover;">
                            <h4>{{ $dish->dishe_title }}</h4>
                            <p>{{ $dish->dishe_description }}</p>
                        </a>
                    </div>
                </div><!-- Card Item -->
            @endforeach
        </div>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $dishes->links() }}
    </div>
</section><!-- End Our Dishes Section -->
@endsection