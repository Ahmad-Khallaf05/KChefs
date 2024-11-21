@extends('layouts.dashboard')

@section('content')
<div class="content">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="title-1">Product Details</h2>
            <a href="{{ route('dishes.dashboard.index') }}">
                <button type="button" class="btn btn-primary btn-sm">
                    <i class="zmdi zmdi-arrow-back"></i> Back to Products
                </button>
            </a>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>{{ $dish->dishe_title }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        {{-- Main Dish Image --}}
                        <div class="form-group mb-3">
                            <label for="dish_images">Dish Image:</label>
                            <img id="main-image" src="{{ asset($dish->images->first()->image_path ?? '') }}" alt="{{ $dish->dishe_title }}" class="img-fluid mb-3" style="max-height: 400px; object-fit: cover;">
                        </div>

                        {{-- Thumbnail Gallery --}}
                        <label for="dish_images">Gallery:</label>
                        <div class="d-flex flex-wrap">
                            @if($dish->images->isNotEmpty())
                                @foreach($dish->images as $image)
                                    <div class="m-2">
                                        <img src="{{ asset($image->image_path) }}" alt="{{ $dish->dishe_title }}" class="img-thumbnail" style="max-height: 100px; cursor: pointer;" onclick="changeImage('{{ asset($image->image_path) }}')">
                                    </div>
                                @endforeach
                            @else
                                <p>No images available</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="dishe_title">Dish Title:</label>
                            <p class="h5">{{ $dish->dish_title }}</p>
                        </div>

                        <div class="form-group mb-3">
                            <label for="dishe_description">Dish Description:</label>
                            <p>{{ $dish->dish_description }}</p>
                        </div>

                        <div class="form-group mb-3">
                            <label for="dish_category_id">Category:</label>
                            <p class="badge badge-secondary">{{ $dish->category->dish_category_name ?? 'N/A' }}</p>
                        </div>

                        <div class="form-group mb-3">
                            <label for="chef_id">Chef:</label>
                            <p>{{ $dish->chef->username ?? 'N/A' }}</p>
                        </div>

                        <div class="form-group mb-3">
                            <label for="price">Price:</label>
                            <p class="h5 text-success">{{ number_format($dish->price, 2) }}$</p>
                        </div>

                        <div class="form-group mb-3">
                            <button class="btn btn-warning btn-lg btn-block" onclick="confirmDelete('{{ route('dishes.dashboard.destroy', $dish) }}')">Delete Dish</button>
                            <a href="{{ route('dishes.dashboard.edit', $dish) }}" class="btn btn-info btn-lg btn-block">Edit Dish</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function changeImage(imageUrl) {
        document.getElementById('main-image').src = imageUrl;
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
