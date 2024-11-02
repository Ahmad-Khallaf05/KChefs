@extends('layouts.home')

@section('content')
<br><br><br><br>
<section id="our-chefs" class="our-chefs section">

    <div class="container section-title" data-aos="fade-up">
        <h2>OUR CHEFS</h2>
        <p>Meet our talented chefs.</p>
    </div>
    <div class="container">
        <div class="row gy-4">
            <!-- Dynamic chefs listing -->
            @foreach($chefs as $chef)
                <div class="col-lg-4" data-aos="fade-up">
                    <div class="member">
                        <a href="{{ route('chefs.show', $chef->chef_id) }}" class="stretched-link">
                            <img src="{{ asset('storage/' . $chef->profile_picture) }}" alt="{{ $chef->username }}" class="img-fluid">
                        </a>
                        <div class="member-info">
                            <div class="member-info-content">
                                <h4>{{ $chef->username }}</h4>
                                <span>{{ $chef->chef_specialties }}</span>
                            </div>
                            <div class="social">
                                <a href="#"><i class="bi bi-twitter"></i></a>
                                <a href="#"><i class="bi bi-facebook"></i></a>
                                <a href="#"><i class="bi bi-instagram"></i></a>
                                <a href="#"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $chefs->links() }}
    </div>

</section>
@endsection
