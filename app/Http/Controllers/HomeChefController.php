<?php

namespace App\Http\Controllers;

use App\Models\Chef;
use Illuminate\Http\Request;

class HomeChefController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Chef::query();
    
        // Filter by specialties if the input is provided
        if ($request->filled('chef_specialties')) {
            $query->where('chef_specialties', 'like', '%' . $request->chef_specialties . '%');
        }
    
        // Search by username or email if the input is provided
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
    
        // Return the view with the chefs and specialties
        return view('home.chefs', compact('chefs', 'specialties'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Logic for creating a new chef (if needed)
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Logic for storing a new chef (if needed)
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Logic for showing a specific chef (if needed)
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Logic for editing a specific chef (if needed)
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Logic for updating a specific chef (if needed)
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Logic for deleting a specific chef (if needed)
    }
}
