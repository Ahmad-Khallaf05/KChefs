<?php

namespace App\Http\Controllers;

use App\Models\Chef;
use App\Models\Dish;
use App\Models\DishCategory;
use Illuminate\Http\Request;

class dishController extends Controller
{
    // Display a listing of the resource.
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
        $dishes = $query->with('category', 'chef')->paginate(10); // Eager load chef for display if needed

        return view('dashboard.dishes.index', compact('dishes', 'categories'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        // Retrieve all categories for the form using pluck
        $categories = DishCategory::pluck('category_name', 'dish_category_id');

        // Retrieve all chefs for the dropdown
        $chefs = Chef::all();

        return view('dashboard.dishes.create', compact('categories', 'chefs'));
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'dishe_title' => 'required|unique:dishes,dishe_title',
            'dishe_description' => 'required',
            'dish_category_id' => 'required|exists:dish_categories,dish_category_id',
            'chef_id' => 'required|exists:chefs,chef_id',
            'price' => 'required|numeric|min:0',
        ]);

        // Create new dish with dish_category_id and chef_id
        Dish::create([
            'dishe_title' => $request->dishe_title,
            'dishe_description' => $request->dishe_description,
            'dish_category_id' => $request->dish_category_id,
            'chef_id' => $request->chef_id,
            'price' => $request->price,
        ]);

        // Redirect after successful creation
        return redirect()->route('dishes.dashboard.index')->with('success', 'Dish created successfully.');
    }

    // Display the specified resource.
    public function show(Dish $dish)
{
    // Load the category and chef relationships with the dish
    $dish->load('category', 'chef');

    return view('dashboard.dishes.show', compact('dish'));
}


    // Show the form for editing the specified resource.
    public function edit(Dish $dish)
{
    $categories = DishCategory::pluck('category_name', 'dish_category_id');
    $chefs = Chef::all(); // Assuming Chef is the model name

    return view('dashboard.dishes.edit', compact('dish', 'categories', 'chefs'));
}

public function update(Request $request, Dish $dish)
{
    $request->validate([
        'dishe_title' => 'required|string|max:255',
        'dishe_description' => 'required|string',
        'dish_category_id' => 'required|exists:dish_categories,dish_category_id',
        'chef_id' => 'required|exists:chefs,id',
        'price' => 'required|numeric|min:0',
    ]);

    $dish->update($request->all());

    return redirect()->route('dishes.dashboard.index')->with('success', 'Dish updated successfully!');
}


    // Remove the specified resource from storage.
    public function destroy(Dish $dish)
    {
        $dish->delete();
        return redirect()->route('dishes.dashboard.index')->with('success', 'Dish deleted successfully.');
    }
}
