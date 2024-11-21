<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\DishCategory;
use App\Models\Chef;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChefDishController extends Controller
{
    // Apply middleware to ensure only logged-in chefs can access their dishes
    public function __construct()
    {
        $this->middleware('auth'); // Ensure the user is authenticated
    }

    // Display a listing of the dishes that belong to the logged-in chef
    public function index(Request $request)
    {
        // Get the logged-in user's chef_id from the chefs table directly
        $chef = Chef::where('user_id', Auth::id())->first();

        if (!$chef) {
            abort(403, 'Unauthorized action.');
        }

        // Get all categories for filtering options
        $categories = DishCategory::all();

        // Build the query to get dishes that belong to the logged-in chef
        $query = Dish::where('chef_id', $chef->id); // Filter by logged-in chef

        // Filter by category if provided
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // Filter by search if provided (title, description, or chef username)
        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->where('dish_title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Paginate the results
        $dishes = $query->paginate(10);

        // Return the index view with filtered dishes and categories
        return view('dashboard.ChefDishes.index', compact('dishes', 'categories'));
    }

    // Show the form to create a new dish
    public function create()
    {
        // Get the logged-in user's chef_id from the chefs table directly
        $chef = Chef::where('user_id', Auth::id())->first();

        if (!$chef) {
            abort(403, 'Unauthorized action.');
        }

        // Get all categories for the form dropdown
        $categories = DishCategory::all();

        return view('dashboard.ChefDishes.create', compact('categories', 'chef'));
    }

    // Store a newly created dish in storage
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'dish_title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        // Get the logged-in user's chef_id from the chefs table directly
        $chef = Chef::where('user_id', Auth::id())->first();

        if (!$chef) {
            abort(403, 'Unauthorized action.');
        }

        // Create the new dish record and associate it with the logged-in chef
        Dish::create([
            'dish_title' => $request->dish_title,
            'category_id' => $request->category_id,
            'chef_id' => $chef->id, // Associate the dish with the logged-in chef
            'price' => $request->price,
            'description' => $request->description,
        ]);

        // Redirect to the dishes index with a success message
        return redirect()->route('ChefDishes.dashboard.index')->with('success', 'Dish created successfully!');
    }

    // Display the specified dish
    public function show(Dish $dish)
    {
        // Ensure that the dish belongs to the logged-in chef
        $chef = Chef::where('user_id', Auth::id())->first();

        if (!$chef || $dish->chef_id !== $chef->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('dashboard.ChefDishes.show', compact('dish'));
    }

    // Show the form to edit the specified dish
    public function edit(Dish $dish)
    {
        // Ensure that the dish belongs to the logged-in chef
        $chef = Chef::where('user_id', Auth::id())->first();

        if (!$chef || $dish->chef_id !== $chef->id) {
            abort(403, 'Unauthorized action.');
        }

        // Get all categories for the form dropdown
        $categories = DishCategory::all();

        return view('dashboard.ChefDishes.edit', compact('dish', 'categories'));
    }

    // Update the specified dish in storage
    public function update(Request $request, Dish $dish)
    {
        // Ensure that the dish belongs to the logged-in chef
        $chef = Chef::where('user_id', Auth::id())->first();

        if (!$chef || $dish->chef_id !== $chef->id) {
            abort(403, 'Unauthorized action.');
        }

        // Validate the incoming request data
        $request->validate([
            'dish_title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        // Update the dish with the new data
        $dish->update($request->all());

        // Redirect to the dishes index with a success message
        return redirect()->route('ChefDishes.dashboard.index')->with('success', 'Dish updated successfully!');
    }

    // Remove the specified dish from storage
    public function destroy(Dish $dish)
    {
        // Ensure that the dish belongs to the logged-in chef
        $chef = Chef::where('user_id', Auth::id())->first();

        if (!$chef || $dish->chef_id !== $chef->id) {
            abort(403, 'Unauthorized action.');
        }

        // Delete the dish
        $dish->delete();

        // Redirect to the dishes index with a success message
        return redirect()->route('ChefDishes.dashboard.index')->with('success', 'Dish deleted successfully!');
    }
}
