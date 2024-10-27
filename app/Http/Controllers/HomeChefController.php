<?php

namespace App\Http\Controllers;

use App\Models\Chef;
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
            $query->where('chef_specialties', 'like', '%' . $request->chef_specialties . '%');
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
        $specialties = Chef::distinct()->pluck('chef_specialties');
    
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

    /**
     * Show the form for creating a new chef.
     */
    public function create()
    {
        // Logic for creating a new chef (if needed)
    }

    /**
     * Store a newly created chef in storage.
     */
    public function store(Request $request)
    {
        // Logic for storing a new chef (if needed)
    }

    /**
     * Show the form for editing the specified chef.
     */
    public function edit($id)
    {
        // Logic for editing a specific chef (if needed)
    }

    /**
     * Update the specified chef in storage.
     */
    public function update(Request $request, $id)
    {
        // Logic for updating a specific chef (if needed)
    }

    /**
     * Remove the specified chef from storage.
     */
    public function destroy($id)
    {
        // Logic for deleting a specific chef (if needed)
    }
}
