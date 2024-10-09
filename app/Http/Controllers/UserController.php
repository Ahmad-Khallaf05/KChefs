<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $users = User::all();
        return view('dashboard.users.index', compact('users'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return view('dashboard.users.create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
{
    // Validate incoming request data
    $request->validate([
        'username' => 'required|unique:users',
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        'role' => 'required|in:user,admin', // Ensure role is either 'user' or 'admin'
    ]);

    // Create new user with the specified role
    User::create([
        'username' => $request->username,
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => $request->role, // Set role from the form
    ]);

    // Redirect after successful creation
    return redirect()->route('users.dashboard.index')->with('success', 'User created successfully.');
}


    // Display the specified resource.
    public function show(User $user)
{
    return view('dashboard.users.show', compact('user'));
}


    // Show the form for editing the specified resource.
    public function edit(User $user)
    {
        return view('dashboard.users.edit', compact('user'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, User $user)
    {
        // Validate the request
        $request->validate([
            'username' => 'required|unique:users,username,' . $user->id,
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:user,admin', // Validate that the role is either 'user' or 'admin'
        ]);
    
        // Update user details including the role
        $user->update($request->only(['username', 'first_name', 'last_name', 'email', 'role']));
    
        // Update password if provided
        if ($request->filled('password')) {
            $user->update(['password' => bcrypt($request->password)]);
        }
    
        // Redirect with success message
        return redirect()->route('users.dashboard.index')->with('success', 'User updated successfully.');
    }
    

    // Remove the specified resource from storage.
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.dashboard.index')->with('success', 'User deleted successfully.');
    }
}
