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

<br><br><br><br>
<section id="chef-profile" class="chef-profile section">
    <div class="container section-title" data-aos="fade-up">
        <h2>{{ $chef->username }}'s Profile</h2>
        <p>{{ $chef->first_name }} {{ $chef->last_name }}</p>
    </div>

    <div class="container">
        <div class="row mb-4">
            <div class="col-md-3 text-center">
                @if($chef->profile_picture)
                    <img src="{{ asset('storage/' . $chef->profile_picture) }}" alt="Profile Picture" class="img-thumbnail rounded-square" width="400">
                @else
                    <img src="{{ asset('default-profile.png') }}" alt="Default Profile Picture" class="img-thumbnail rounded-square" width="400">
                @endif
            </div>
            <div class="col-md-8">
                <h3>{{ $chef->first_name }} {{ $chef->last_name }}</h3>
                <p><strong>Specialties:</strong> {{ $chef->chef_specialties }}</p>
                <p><strong>Email:</strong> {{ $chef->email }}</p>
                <p><strong>Phone:</strong> {{ $chef->phone ?? 'N/A' }}</p>
                <p><strong>Bio:</strong> {{ $chef->bio ?? 'N/A' }}</p>
            </div>
        </div>
    </div>

    <div class="container section-title" data-aos="fade-up">
        <h2>{{ $chef->username }}'s Dishes</h2>
        <p>Discover the delicious dishes prepared by {{ $chef->username }}.</p>
    </div>

    <!-- Dishes Cards -->
    <div class="container">
        <div class="row gy-4">
            @foreach($chef->dishes as $dish)
                <div class="col-lg-4">
                    <div class="card-item">
                        <a href="{{ route('dishes.show', $dish->dish_id) }}" class="stretched-link">
                            <img src="{{ asset($dish->image_path ?? './assets/home/img/dishes/default-dish.jpg') }}" alt="{{ $dish->dish_title }}" class="card-image">
                            <h2>{{ $dish->dish_title }}</h2>
                            <p><strong>Price:</strong> ${{ number_format($dish->price, 2) }}</p>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <br>
</section>
@endsection
