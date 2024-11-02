<?php

namespace App\Http\Controllers;

use App\Models\ChefSpecialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChefSpecialtyController extends Controller
{
    /**
     * Display a listing of the specialties.
     */
    public function index()
    {
        $specialties = ChefSpecialty::all(); // Get all chef specialties
        return view('dashboard.chef_specialties.index', compact('specialties'));
    }

    /**
     * Show the form for creating a new specialty.
     */
    public function create()
    {
        return view('dashboard.chef_specialties.create'); // Show the create form
    }

    /**
     * Store a newly created specialty in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('chef_specialties.dashboard.create')
                ->withErrors($validator)
                ->withInput();
        }

        // Create a new specialty
        ChefSpecialty::create($request->only('name'));

        // Redirect with success message
        return redirect()->route('chef_specialties.dashboard.index')->with('success', 'Chef specialty created successfully.');
    }

    /**
     * Show the form for editing the specified specialty.
     */
    public function edit($id)
    {
        $specialty = ChefSpecialty::findOrFail($id); // Find the specialty or fail
        return view('dashboard.chef_specialties.edit', compact('specialty'));
    }

    /**
     * Update the specified specialty in storage.
     */
    public function update(Request $request, $id)
    {
        // Find the specialty by ID or fail
        $specialty = ChefSpecialty::findOrFail($id);

        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Update the specialty
        $specialty->update([
            'name' => $request->name,
        ]);

        // Redirect with success message
        return redirect()->route('chef_specialties.dashboard.index')->with('success', 'Chef specialty updated successfully.');
    }

    /**
     * Remove the specified specialty from storage.
     */
    public function destroy($id)
    {
        $specialty = ChefSpecialty::findOrFail($id);
        $specialty->delete(); // Soft delete

        return redirect()->route('chef_specialties.dashboard.index')->with('success', 'Chef specialty deleted successfully.');
    }

    /**
     * Display the specified specialty (optional).
     */
    public function show($id)
    {
        $specialty = ChefSpecialty::findOrFail($id);
        return view('dashboard.chef_specialties.show', compact('specialty'));
    }
}
