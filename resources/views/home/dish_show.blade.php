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

    .card-item img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        border-radius: 10px;
    }

    .card-item h2,
    .card-item p {
        color: #fff;
    }

    .details-section label {
        font-weight: bold;
        color: #fff;
    }

    .details-section p {
        color: #cda45e;
    }



    .gallery img:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    }
</style>

<br>
<br>
<br>
<br>
<br>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="title-1 text-white">Product Details</h2>
        <a href="{{ url()->previous() }}">
            <button type="button" class="btn btn-primary btn-sm">
                <i class="zmdi zmdi-arrow-back"></i> Back
            </button>
        </a>
    </div>

    <div class="card-item">
        <div class="row">
            <div class="col-md-6">
                {{-- Main Dish Image --}}
                <div class="form-group mb-3">
                    <img id="main-image" src="{{ asset($dish->images->first()->image_path ?? 'default-image.png') }}"
                        alt="{{ $dish->dish_title }}" class="img-fluid">
                </div>

                {{-- Thumbnail Gallery --}}
                <label for="dish_images">Gallery:</label>
                <div class="d-flex flex-wrap">
                    @if($dish->images->isNotEmpty())
                        @foreach($dish->images as $image)
                            <div class="m-2">
                                <img src="{{ asset($image->image_path) }}" alt="{{ $dish->dishe_title }}" class="img-thumbnail"
                                    style="max-height: 100px; cursor: pointer;"
                                    onclick="changeImage('{{ asset($image->image_path) }}')">
                            </div>
                        @endforeach
                    @else
                        <p>No images available</p>
                    @endif
                </div>
            </div>

            <div class="col-md-6 details-section">
                <div class="form-group mb-3">
                    <label for="dish_title">Dish Title:</label>
                    <p>{{ $dish->dish_title }}</p>
                </div>

                <div class="form-group mb-3">
                    <label for="dish_description">Dish Description:</label>
                    <p>{{ $dish->dish_description }}</p>
                </div>

                <div class="form-group mb-3">
                    <label for="dish_category_id">Category:</label>
                    <p>{{ $dish->category->dish_category_name ?? 'N/A' }}</p>
                </div>

                <div class="form-group mb-3">
                    <label for="chef_id">Chef:</label>
                    <p>{{ $dish->chef->username ?? 'N/A' }}</p>
                </div>
                <div class="form-group mb-3">
                    <label for="chef_id">Chef email:</label>
                    <p>{{ $dish->chef->email ?? 'N/A' }}</p>
                </div>
                <div class="form-group mb-3">
                    <label for="chef_id">Chef phone:</label>
                    <p>{{ $dish->chef->phone ?? 'N/A' }}</p>
                </div>

                <div class="form-group mb-3">
                    <label for="price">Price:</label>
                    <p class="h5 text-success">{{ number_format($dish->price, 2) }}$</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function changeImage(imageUrl) {
        document.getElementById('main-image').src = imageUrl;
    }
</script>

@endsection