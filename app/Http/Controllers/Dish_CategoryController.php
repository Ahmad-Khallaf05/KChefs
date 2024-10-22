<?php

namespace App\Http\Controllers;

use App\Models\DishCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Dish_CategoryController extends Controller
{
    // Display a listing of the dish categories
    public function index()
    {
        $categories = DishCategory::all();
        return view('dashboard.categories.index', compact('categories'));
    }

    // Show the form for creating a new dish category
    public function create()
    {
        return view('dish_categories.create');
    }

    // Store a newly created dish category in the database
    public function store(Request $request)
    {
        $request->validate([
            'dish_category_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            $imagePath = null;
        }

        DishCategory::create([
            'dish_category_name' => $request->dish_category_name,
            'description' => $request->description,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('dish_categories.index')
                         ->with('success', 'Dish category created successfully.');
    }

    // Display a specific dish category
    public function show($id)
    {
        $category = DishCategory::findOrFail($id);
        return view('dish_categories.show', compact('category'));
    }

    // Show the form for editing a specific dish category
    public function edit($id)
    {
        $category = DishCategory::findOrFail($id);
        return view('dish_categories.edit', compact('category'));
    }

    // Update a specific dish category in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'dish_category_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $category = DishCategory::findOrFail($id);

        // Handle image upload if a new one is provided
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($category->image_path) {
                Storage::delete('public/' . $category->image_path);
            }

            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            $imagePath = $category->image_path; // Keep the old image if no new image is provided
        }

        $category->update([
            'dish_category_name' => $request->dish_category_name,
            'description' => $request->description,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('dish_categories.index')
                         ->with('success', 'Dish category updated successfully.');
    }

    // Remove a specific dish category from the database
    public function destroy($id)
    {
        $category = DishCategory::findOrFail($id);

        // Delete the image if it exists
        if ($category->image_path) {
            Storage::delete('public/' . $category->image_path);
        }

        $category->delete();

        return redirect()->route('dish_categories.index')
                         ->with('success', 'Dish category deleted successfully.');
    }
}
