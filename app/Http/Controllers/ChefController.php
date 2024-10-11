<?php

namespace App\Http\Controllers;

use App\Models\Chef;
use Illuminate\Http\Request;
use Storage;

class ChefController extends Controller
{ 
    public function index(Request $request)
    {
        $query = Chef::query();
    
        if ($request->filled('chef_specialties')) {
            $query->where('chef_specialties', 'like', '%' . $request->chef_specialties . '%');
        }
    
       
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('username', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $chefs = $query->paginate(10);
        
        $specialties = Chef::distinct()->pluck('chef_specialties');
    
        return view('dashboard.chefs.index', compact('chefs', 'specialties'));
    }
    

    // Show the form for creating a new resource.
    public function create()
    {
        return view('dashboard.chefs.create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
      

        $request->validate([
            'username' => 'required|unique:users',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'chef_specialties' => 'required', 
            'password' => 'required|min:8',
        ]);
        
        Chef::create([
            'username' => $request->username,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'chef_specialties' => $request->chef_specialties,
            'password' => bcrypt($request->password),
        ]);
        
        

        return redirect()->route('chefs.dashboard.index')->with('success', 'chef created successfully.');
    }


    // Display the specified resource.
    public function show(Chef $chef)
    {
        return view('dashboard.chefs.show', compact('chef'));
    }


    // Show the form for editing the specified resource.
    public function edit(Chef $chef)
    {
        return view('dashboard.chefs.edit', compact('chef'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, Chef $chef)
{

    $request->validate([
        'username' => 'required|unique:users,username,' . $chef->id,
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email|unique:users,email,' . $chef->id,
        'chef_specialties' => 'required|string',
        'phone' => 'nullable|string|max:15',
        'bio' => 'nullable|string',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $chef->update($request->only([
        'username', 'first_name', 'last_name', 'email', 'chef_specialties', 'phone', 'bio'
    ]));

    if ($request->hasFile('profile_picture')) {
        
        $path = $request->file('profile_picture')->store('profile_pictures', 'public');

        if ($chef->profile_picture) {
            Storage::disk('public')->delete($chef->profile_picture);
        }

        $chef->update(['profile_picture' => $path]);
    }

    if ($request->filled('password')) {
        $chef->update(['password' => bcrypt($request->password)]);
    }

    return redirect()->route('chefs.dashboard.index')->with('success', 'chef updated successfully.');
}



    // Remove the specified resource from storage.
    public function destroy(Chef $chef)
    {
        $chef->delete();
        return redirect()->route('chefs.dashboard.index')->with('success', 'User deleted successfully.');
    }
}
