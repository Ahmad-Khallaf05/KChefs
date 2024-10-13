@extends('layouts.home')

@section('content')
<br>
<br>
<br>
<br>
<section id="our-chefs" class="our-chefs section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>OUR CHEFS</h2>
        <p>Meet our talented chefs.</p>
    </div><!-- End Section Title -->

    <style>
        .card-item {
            background-color: #191815; /* Background color */
            border: 2px solid #000; /* Border color and width */
            border-radius: 10px; /* Rounding the corners */
            padding: 10px; /* Space between the border and content */
            position: relative; /* Positioning for the link */
            overflow: hidden; /* Ensures the image doesn't overflow */
            transition: transform 0.2s, box-shadow 0.2s, background-color 0.2s; /* Adds animation for scaling, shadow, and background color */
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
    </style>

    <div class="container">
        <div class="row gy-4">

            @foreach($chefs as $index => $chef)
                <div class="col-lg-4">
                    <div class="card-item">
                        <a href="{{ route('chefs', $chef->id) }}" class="stretched-link">
                            <img src="{{ asset('./assets/home/img/chefs/chefs-1.jpg') }}" alt="{{ $chef->username }}" class="img-fluid rounded mb-3" style="width: 100%; height: 250px; object-fit: cover;">
                            <h4>{{ $chef->username }}</h4>
                            <p>{{ $chef->chef_specialties }}</p>
                        </a>
                    </div>
                </div><!-- Card Item -->
            @endforeach

        </div>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $chefs->links() }}
    </div>

</section><!-- End Our Chefs Section -->

@endsection
