@extends('layouts.home')

@section('content')
<br><br><br><br>
<!-- Chefs Section -->
<section id="chefs" class="chefs section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>OUR CHEFS</h2>
        <p>Meet our talented chefs.</p>
    </div><!-- End Section Title -->

    <div class="container">
        <div class="row gy-4">
            <!-- Dynamic chefs listing -->
            @foreach($chefs as $index => $chef)
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="{{ 100 * ($index + 1) }}">
                    <div class="card member">
                        <a href="{{ route('chefs.show', $chef->chef_id) }}" class="stretched-link">
                            <img src="{{ $chef->profile_picture ? asset('storage/' . $chef->profile_picture) : asset('./assets/home/img/about.jpg') }}"
                                alt="{{ $chef->username }}'s profile picture" class="card-img-top img-fluid" loading="lazy">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">{{ $chef->username }}</h5>
                            <p class="card-text">{{ $chef->chef_specialties }}</p>
                            <a href="{{ route('chefs.show', $chef->chef_id) }}" class="btn btn-primary">View Profile</a>
                        </div>
                    </div><!-- End Card -->
                </div><!-- End Team Member -->
            @endforeach
        </div>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $chefs->links() }}
    </div>

</section><!-- /Chefs Section -->
@endsection
