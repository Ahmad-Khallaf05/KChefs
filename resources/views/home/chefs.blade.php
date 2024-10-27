@extends('layouts.home')

@section('content')
<br><br><br><br>
<section id="our-chefs" class="our-chefs section">

    <div class="container section-title" data-aos="fade-up">
        <h2>OUR CHEFS</h2>
        <p>Meet our talented chefs.</p>
    </div>

    <style>
        .card-item {
            background: linear-gradient(135deg, #191815 0%, #2c2a28 100%);
            border: 2px solid #000; 
            border-radius: 10px; 
            padding: 20px; 
            position: relative; 
            overflow: hidden; 
            transition: transform 0.3s, box-shadow 0.3s, background-color 0.3s;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        }

        .card-item a {
            text-decoration: none;
            color: #fff;
            display: block;
            height: 100%; 
        }

        .card-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
            background-color: #cda45e; 
        }

        .chef-image {
            width: 100%;
            height: 250px; 
            object-fit: cover; 
            border-radius: 10px; 
            margin-bottom: 15px; 
        }

        h4 {
            margin: 10px 0; 
            font-size: 1.5rem; 
            font-weight: bold; 
            text-align: center; 
        }

        p {
            font-size: 1.1rem; 
            text-align: center; 
        }
    </style>

    <div class="container">
        <div class="row gy-4">

            @foreach($chefs as $index => $chef)
                <div class="col-lg-4">
                    <div class="card-item">
                        <a href="{{ route('chefs.show', $chef->chef_id) }}" class="stretched-link">
                            <img src="{{ asset('storage/' . $chef->profile_picture) }}" alt="{{ $chef->username }}" class="chef-image">
                            <h4>{{ $chef->username }}</h4>
                            <p>{{ $chef->chef_specialties }}</p>
                        </a>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $chefs->links() }}
    </div>

</section>

@endsection
