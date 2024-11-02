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
        $query = Dish::query();

        // Filtering by search, category, and chef
        if ($request->filled('search')) {
            $query->where('dish_title', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        if ($request->filled('chef')) {
            $query->where('chef_id', $request->chef);
        }

        // Fetch categories, chefs, and paginated dishes for display
        $categories = DishCategory::all();
        $chefs = Chef::all();
        $dishes = $query->paginate(9);

        return view('home.dishes', compact('dishes', 'categories', 'chefs'));
    }

    public function show($id)
    {
        // Find dish with related image, chef, and category
        $dish = Dish::with(['primaryImage', 'chef', 'category'])->findOrFail($id);
        return view('home.dish_show', compact('dish'));
    }
}
