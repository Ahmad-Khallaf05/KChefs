@extends('layouts.home')

@section('content')
<br><br><br><br><br>
<div class="content">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="title-1">Dish Details</h2>
            <a href="{{ route('dishes.index') }}">
                <button type="button" class="btn btn-primary btn-sm">
                    <i class="zmdi zmdi-arrow-back"></i> Back to Dishes
                </button>
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        {{-- Main Image Display --}}
                        <div class="main-image">
                            @if($dish->images->isNotEmpty())
                                <img id="mainImage" src="{{ asset($dish->images->first()->image_path) }}" alt="{{ $dish->dish_title }}" class="img-fluid" style="max-height: 400px; object-fit: cover; width: 100%;">
                            @else
                                <p>No images available</p>
                            @endif
                        </div>

                        {{-- Swiper for Thumbnail Images --}}
                        @if($dish->images->count() > 1)
                        <label>Other Images:</label>
                        <div class="swiper-container thumbnail-swiper mt-3">
                            <div class="swiper-wrapper">
                                @foreach($dish->images as $image)
                                    <div class="swiper-slide">
                                        <img src="{{ asset($image->image_path) }}" alt="{{ $dish->dish_title }}" class="img-thumbnail" style="max-height: 100px; object-fit: cover; cursor: pointer;" onclick="changeMainImage('{{ asset($image->image_path) }}')">
                                    </div>
                                @endforeach
                            </div>
                            <!-- Swiper Pagination -->
                            <div class="swiper-pagination"></div>
                        </div>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>Dish Title:</label>
                            <p class="h5">{{ $dish->dish_title }}</p>
                        </div>

                        <div class="form-group mb-3">
                            <label>Dish Description:</label>
                            <p>{{ $dish->dish_description }}</p>
                        </div>

                        <div class="form-group mb-3">
                            <label>Category:</label>
                            <p class="badge badge-secondary">{{ $dish->category->dish_category_name ?? 'N/A' }}</p>
                        </div>

                        <div class="form-group mb-3">
                            <label>Chef:</label>
                            <p>{{ $dish->chef->username ?? 'N/A' }}</p>
                        </div>

                        <div class="form-group mb-3">
                            <label>Price:</label>
                            <p class="h5 text-success">{{ number_format($dish->price, 2) }}$</p>
                        </div>

                        <div class="form-group mb-3">
                            <label>Ratings:</label>
                            <p>
                                <span class="text-warning">
                                    @for($i = 0; $i < 5; $i++)
                                        <i class="zmdi zmdi-star{{ $dish->rating > $i ? '' : '-outline' }}"></i>
                                    @endfor
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Swiper JS and Initialization -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

<script>
    // Initialize Swiper for Thumbnails
    var thumbnailSwiper = new Swiper('.thumbnail-swiper', {
        loop: false,
        slidesPerView: 3, // Show exactly 3 images at a time
        spaceBetween: 10, // Spacing between images
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });

    // Change main image when thumbnail is clicked
    function changeMainImage(imageUrl) {
        document.getElementById('mainImage').src = imageUrl;
    }

    function confirmDelete(deleteUrl) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.createElement('form');
                form.action = deleteUrl;
                form.method = 'POST';

                var csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}';

                var methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';

                form.appendChild(csrfInput);
                form.appendChild(methodInput);
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>

@endsection
