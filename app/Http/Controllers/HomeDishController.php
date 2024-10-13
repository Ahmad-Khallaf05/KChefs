<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\DishCategory; // Import the DishCategory model
use Illuminate\Http\Request;

class HomeDishController extends Controller
{
    public function index(Request $request)
    {
        $query = Dish::query();

        // Filter by category
        if ($request->filled('category')) {
            $query->where('dish_category_id', $request->category);
        }

        // Search by name or description
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('dishe_title', 'like', '%' . $request->search . '%')
                  ->orWhere('dishe_description', 'like', '%' . $request->search . '%');
            });
        }

        // Get categories for filtering
        $categories = DishCategory::pluck('category_name', 'dish_category_id');

        // Paginate the dishes with eager loading
        $dishes = $query->with(['category', 'chef'])->paginate(10); // Eager load category and chef

        return view('home.dishes', compact('dishes', 'categories'));
    }
}
