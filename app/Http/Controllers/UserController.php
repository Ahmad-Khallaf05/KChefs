<?php

namespace App\Http\Controllers;

use App\Models\Chef;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // Display a listing of the resource.
    public function index(Request $request)
{
    $query = User::query();

    if ($request->filled('role')) {
        $query->where('role', $request->role);
    }

    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('username', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
        });
    }

    // Exclude the currently logged-in user
    $query->where('id', '!=', auth()->id());

    $users = $query->paginate(10);
    $roles = User::distinct()->pluck('role');

    return view('dashboard.users.index', compact('users', 'roles'));
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
            'role' => 'required|in:user,admin',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validate profile picture
            'phone' => 'nullable|string|max:15',
            'bio' => 'nullable|string|max:500',
        ]);

        // Handle profile picture upload
        $profilePicturePath = $request->file('profile_picture')
            ? $request->file('profile_picture')->store('profile_pictures', 'public')
            : null;

        // Create new user with the specified role
        User::create([
            'username' => $request->username,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'profile_picture' => $profilePicturePath, // Store profile picture path
            'phone' => $request->phone,
            'bio' => $request->bio,
        ]);

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
        $request->validate([
            'username' => 'required|unique:users,username,' . $user->id,
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:user,admin',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validate profile picture
            'phone' => 'nullable|string|max:15',
            'bio' => 'nullable|string|max:500',
        ]);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if exists
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            // Store new profile picture
            $user->profile_picture = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        // Update user details including the role
        $user->update($request->only(['username', 'first_name', 'last_name', 'email', 'role', 'phone', 'bio']));

        // Update password if provided
        if ($request->filled('password')) {
            $user->update(['password' => bcrypt($request->password)]);
        }

        return redirect()->route('users.dashboard.index')->with('success', 'User updated successfully.');
    }

    // View profile for authenticated users
    public function viewProfile()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return view('profiles.admin', compact('user'));
        } elseif ($user->role === 'user') {
            return view('profiles.user', compact('user'));
        } else {
            // Chef profile logic
            $chef = Chef::find($user->id);
            return view('profiles.chef', compact('chef'));
        }
    }
}
