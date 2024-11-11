<?php

namespace App\Http\Controllers;

use App\Models\Chef;
use App\Models\Dish;
use App\Models\DishCategory;
use Illuminate\Http\Request;

class HomeDishController extends Controller
{
    public function index(Request $request)
    {
        $query = Dish::with('firstImage'); // Eager load the firstImage relationship

        if ($request->filled('search')) {
            $query->where('dish_title', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('category')) {
            $query->where('dish_category_id', $request->category);
        }
        if ($request->filled('chef')) {
            $query->where('chef_id', $request->chef);
        }

        $categories = DishCategory::all();
        $chefs = Chef::all();
        $dishes = $query->paginate(9);

        return view('home.dishes', compact('dishes', 'categories', 'chefs'));
    }

    public function show(Dish $dish)
{
    // Load the dish category, chef, and images relationships
    $dish->load('category', 'chef', 'images');

    return view('home.dish_show', compact('dish'));
}
}
