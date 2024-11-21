@extends('layouts.home')

@section('content')
<style>
    .card-item {
        background-color: #191815;
        border: 2px solid #000;
        border-radius: 10px;
        padding: 15px;
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
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
        background-color: #cda45e;
    }

    .card-item:hover h2,
    .card-item:hover p {
        color: #000;
    }

    .card-image {
        width: 100%;
        height: 250px;
        object-fit: cover;
        border-radius: 10px;
    }


    .section-title h2 {
        margin-bottom: 10px;
    }

    .card-item h2 {
        font-size: 1.5rem;
        margin: 10px 0;
    }

    .card-item p {
        font-size: 1.1rem;
    }
</style>

<br><br><br>

<section id="our-chefs" class="our-chefs section">
    <div class="container section-title">
        <h2>OUR CHEFS</h2>
        <p>Discover our talented chefs and their specialties.</p>
    </div>

   <!-- Search and Filter Form -->
<div class="container">
    <form action="{{ route('chefs') }}" method="GET" class="row gy-2 search-filter-form">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control search-input"
                placeholder="Search by Chef Name or Email..." value="{{ request()->get('search') }}">
        </div>
        <div class="col-md-4">
            <select name="chef_specialties" class="form-select specialty-select">
                <option value="">Select Specialty</option>
                @foreach($specialties as $specialty)
                    <option value="{{ $specialty }}" {{ request()->get('chef_specialties') == $specialty ? 'selected' : '' }}>
                        {{ $specialty }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-warning filter-button">Filter</button>
        </div>
    </form>
</div>


    <br>

    <!-- Chefs Cards -->
    <div class="container">
        <div class="row gy-4">
            @foreach($chefs as $chef)
                <div class="col-lg-4">
                    <div class="card-item">
                        <a href="{{ route('chefs.show', $chef->chef_id) }}" class="stretched-link">
                            <img src="{{ asset('storage/' . $chef->profile_picture) }}" alt="Profile Picture"
                                class="card-image">
                            <h2>{{ $chef->username }}</h2>
                            <p><strong>Email:</strong> {{ $chef->email }}</p>
                            <p><strong>Specialties:</strong>
                                {{ $chef->specialties->pluck('name')->implode(', ') }}
                            </p>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $chefs->appends(request()->query())->links() }}
    </div>
</section>
@endsection