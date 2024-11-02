<?php

namespace App\Http\Controllers;

use App\Models\Chef;
use App\Models\ChefSpecialty;
use Illuminate\Http\Request;

class HomeChefController extends Controller
{
    /**
     * Display a listing of chefs with filtering and searching capabilities.
     */
    public function index(Request $request)
    {
        $query = Chef::query();
    
        // Filter by specialties if provided
        if ($request->filled('chef_specialties')) {
            $query->whereHas('specialties', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->chef_specialties . '%');
            });
        }
    
        // Search by username or email if provided
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('username', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }
    
        // Paginate results to 10 per page
        $chefs = $query->paginate(10);
    
        // Get distinct specialties for filtering
        $specialties = ChefSpecialty::distinct()->pluck('name'); // Adjust 'name' based on your specialties table column
    
        // Return the view with chefs and specialties
        return view('home.chefs', compact('chefs', 'specialties'));
    }
    

    /**
     * Display the specified chef's profile along with all of their dishes.
     */
    public function show($chef_id)
    {
        // Retrieve the chef with their dishes using eager loading
        $chef = Chef::with('dishes')->findOrFail($chef_id);

        // Return the profile view with the chef's data and dishes
        return view('home.chef_profile', compact('chef'));
    }

    
}
