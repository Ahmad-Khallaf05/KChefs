@extends('layouts.home')

@section('content')
<br><br><br>
<div class="container mt-5">
    <h2>{{ $dish->dish_title }}</h2>
    <img src="{{ $dish->primaryImage ? asset('storage/' . $dish->primaryImage->image_path) : asset('./assets/home/img/dishes/default.jpg') }}" 
         alt="{{ $dish->dish_title }}" class="img-fluid mb-3" 
         style="width: 100%; height: 400px; object-fit: cover;">
    <p>{{ $dish->dish_description }}</p>
    <p><strong>Category:</strong> {{ $dish->category->dish_category_name }}</p>
    <p><strong>Chef:</strong> {{ $dish->chef->username }}</p>

    <a href="{{ route('dishes.index') }}" class="btn btn-secondary">Back to Dishes</a>
</div>
@endsection
