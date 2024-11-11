<?php

namespace App\Http\Controllers;

use App\Models\Chef;
use App\Models\Dish;
use App\Models\DishCategory;
use App\Models\DishImage;
use Illuminate\Http\Request;

class dishController extends Controller
{
    // Display a listing of the resource.
    public function index(Request $request)
    {
        $query = Dish::with(['category', 'chef']); // Eager load relationships

        // Filter by category
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // Combined search logic
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;

            $query->where(function ($q) use ($searchTerm) {
                $q->where('dish_title', 'LIKE', "%$searchTerm%")
                    ->orWhere('description', 'LIKE', "%$searchTerm%")
                    ->orWhereHas('chef', function ($query) use ($searchTerm) {
                        $query->where('username', 'LIKE', "%$searchTerm%");
                    });
            });
        }

        $dishes = $query->paginate(10);
        $categories = DishCategory::all();

        return view('dashboard.dishes.index', compact('dishes', 'categories'));
    }



    // Show the form for creating a new resource.
    public function create()
    {
        // Retrieve all categories for the form using pluck
        $categories = DishCategory::pluck('dish_category_name', 'dish_category_id');
    
        // Retrieve all chefs for the dropdown
        $chefs = Chef::all();
    
        return view('dashboard.dishes.create', compact('categories', 'chefs'));
    }
    
    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'dish_title' => 'required|string|max:255',
            'dish_description' => 'required|string',
            'dish_category_id' => 'required|exists:dish_categories,dish_category_id',
            'chef_id' => 'required|exists:chefs,chef_id',
            'price' => 'required|numeric|min:0',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust as needed
        ]);
    
        // Create a new Dish instance
        $dish = new Dish();
        $dish->dish_title = $request->dish_title;
        $dish->dish_description = $request->dish_description;
        $dish->dish_category_id = $request->dish_category_id;
        $dish->chef_id = $request->chef_id;
        $dish->price = $request->price;
    
        // Save the dish to the database first
        $dish->save();
    
        // Check if images were uploaded
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images/dishes'), $imageName);
    
                // Create a new DishImage instance for each uploaded image
                $dishImage = new DishImage();
                $dishImage->image_path = 'images/dishes/' . $imageName; // Path to the saved image
                $dishImage->dish_id = $dish->dish_id; // Associate with the created dish
                $dishImage->save(); // Save the image record
            }
        } else {
            // If no images were uploaded, you may decide to create a default image entry
            $dishImage = new DishImage();
            $dishImage->image_path = 'images/dishes/1730798832_Ahmad logo.png'; // Default image path
            $dishImage->dish_id = $dish->dish_id; // Associate with the created dish
            $dishImage->save(); // Save the default image record
        }
    
        // Redirect with a success message
        return redirect()->route('dishes.dashboard.index')->with('success', 'Dish created successfully.');
    }
    
    
    



    // Display the specified resource.
    public function show(Dish $dish)
{
    // Load the dish category, chef, and images relationships
    $dish->load('category', 'chef', 'images');

    return view('dashboard.dishes.show', compact('dish'));
}


    // Show the form for editing the specified resource.
    public function edit(Dish $dish)
    {
        $categories = DishCategory::pluck('dish_category_name', 'dish_category_id'); // Changed to match migration
        $chefs = Chef::all();

        return view('dashboard.dishes.edit', compact('dish', 'categories', 'chefs'));
    }

    public function update(Request $request, Dish $dish)
    {
        $request->validate([
            'dish_title' => 'required|string|max:255|unique:dishes,dish_title,' . $dish->dish_id, // Unique validation adjusted for the current dish
            'dish_description' => 'nullable|string',
            'dish_category_id' => 'required|exists:dish_categories,dish_category_id',
            'chef_id' => 'required|exists:chefs,chef_id',
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
