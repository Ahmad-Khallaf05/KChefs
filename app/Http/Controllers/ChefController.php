<?php

namespace App\Http\Controllers;

use App\Models\Chef;
use App\Models\ChefSpecialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ChefController extends Controller
{
    /**
     * Display a listing of the chefs.
     *
     * @return \Illuminate\Http\Response
     */

    // In ChefController.php (index method)
public function index(Request $request)
{
    $specialties = chefSpecialty::all(); // Retrieve all specialties for filtering

    $query = Chef::with('specialties'); // Eager load specialties

    // Apply filter by specialty if selected
    if ($request->has('specialty') && $request->specialty) {
        $query->whereHas('specialties', function($q) use ($request) {
            $q->where('id', $request->specialty);
        });
    }

    // Apply search by name or specialty
    if ($request->has('search') && $request->search) {
        $query->where(function($q) use ($request) {
            $q->where('first_name', 'like', '%'.$request->search.'%')
                ->orWhere('last_name', 'like', '%'.$request->search.'%')
                ->orWhereHas('specialties', function($q) use ($request) {
                    $q->where('name', 'like', '%'.$request->search.'%');
                });
        });
    }

    $chefs = $query->paginate(10); // Paginate or use get() to retrieve results

    return view('dashboard.chefs.index', compact('chefs', 'specialties'));
}

    

    /**
     * Show the form for creating a new chef.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $specialties = ChefSpecialty::all(); // Get all specialties for the dropdown
        return view('dashboard.chefs.create', compact('specialties'));
    }

    public function store(Request $request)
    {
        // Validate the input
        $validatedData = $request->validate([
            'username' => 'required|string|max:255|unique:chefs',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:chefs',
            'phone' => 'required|string|max:20',
            'bio' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'specialties' => 'array',
            'password' => 'required|string|min:8|confirmed', // Validate password
        ]);

        // Handle the profile picture upload if provided
        if ($request->hasFile('profile_picture')) {
            $validatedData['profile_picture'] = $request->file('profile_picture')->store('profile_pictures');
        }

        // Hash the password
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Create a new chef
        $chef = Chef::create($validatedData);

        // Attach specialties if any were selected
        if ($request->has('specialties')) {
            $chef->specialties()->attach($request->specialties);
        }

        return redirect()->route('chefs.dashboard.index')->with('success', 'Chef added successfully!');
    }


    /**
     * Display the specified chef.
     *
     * @param  Chef  $chef
     * @return \Illuminate\Http\Response
     */
    public function show(Chef $chef)
    {
        return view('dashboard.chefs.show', compact('chef')); // Create a view to display chef details
    }

    /**
     * Show the form for editing the specified chef.
     *
     * @param  Chef  $chef
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $chef = Chef::with('specialties')->findOrFail($id); // Load chef with their specialties
        $specialties = ChefSpecialty::all(); // Retrieve all possible specialties
        
        return view('dashboard.chefs.edit', compact('chef', 'specialties'));
    }
    
    /**
     * Update the specified chef in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Chef  $chef
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $chef = Chef::findOrFail($id);
    
        // Validate the request data, excluding password from required fields
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'chef_specialties' => 'required|array', // Ensure specialties are selected
            'phone' => 'nullable|string',
            'bio' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'password' => 'nullable|string|confirmed|min:8', // Password is optional
        ]);
    
        // Remove password from validatedData if it's empty
        $updateData = $request->except('password'); // Exclude password from the main update
    
        // Update general details without the password
        $chef->update($updateData);
    
        // Sync selected specialties
        $chef->specialties()->sync($request->chef_specialties);
    
        // If a new profile picture is uploaded, update it
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $chef->profile_picture = $path;
            $chef->save();
        }
    
        // Update password if a new one is provided
        if ($request->filled('password')) {
            $chef->password = Hash::make($request->password);
            $chef->save();
        }
    
        return redirect()->route('chefs.dashboard.index')->with('success', 'Chef updated successfully');
    }
    
    

    

    /**
     * Remove the specified chef from storage.
     *
     * @param  Chef  $chef
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chef $chef)
    {
        $chef->specialties()->detach();
        if ($chef->profile_picture) {
            Storage::disk('public')->delete($chef->profile_picture);
        }

        $chef->delete();

        return redirect()->route('chefs.dashboard.index')->with('success', 'Chef deleted successfully.');
    }
}
