<?php

namespace App\Http\Controllers;

use App\Models\Chef;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function create()
    {
        return view('dashboard.chefs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'chef_specialties' => 'required',
            'password' => 'required|min:8',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $profilePicturePath = $this->handleProfilePictureUpload($request);

        Chef::create([
            'username' => $request->username,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'chef_specialties' => $request->chef_specialties,
            'password' => bcrypt($request->password),
            'profile_picture' => $profilePicturePath,
        ]);

        return $this->redirectToDashboard('Chef created successfully.');
    }

    public function show(Chef $chef)
    {
        return view('dashboard.chefs.show', compact('chef'));
    }

    public function edit(Chef $chef)
    {
        return view('dashboard.chefs.edit', compact('chef'));
    }

    public function update(Request $request, Chef $chef)
    {
        $request->validate([
            'username' => 'required|unique:users,username,' . $chef->id,
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $chef->id,
            'chef_specialties' => 'required',
            'phone' => 'nullable|string|max:15',
            'bio' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $chef->update($request->only([
            'username', 'first_name', 'last_name', 'email', 'chef_specialties', 'phone', 'bio'
        ]));

        $profilePicturePath = $this->handleProfilePictureUpload($request, $chef);
        if ($profilePicturePath) {
            $chef->update(['profile_picture' => $profilePicturePath]);
        }

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'min:8'
            ]);
            $chef->update(['password' => bcrypt($request->password)]);
        }

        return $this->redirectToDashboard('Chef updated successfully.');
    }

    public function destroy(Chef $chef)
    {
        if ($chef->profile_picture) {
            Storage::disk('public')->delete($chef->profile_picture);
        }

        $chef->delete();
        return $this->redirectToDashboard('Chef deleted successfully.');
    }

    /**
     * Handle profile picture upload and removal of old picture if necessary.
     */
    private function handleProfilePictureUpload(Request $request, Chef $chef = null)
    {
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');

            if ($chef && $chef->profile_picture) {
                Storage::disk('public')->delete($chef->profile_picture);
            }

            return $path;
        }

        return $chef ? $chef->profile_picture : null;
    }

    /**
     * Redirect to the dashboard with a success message.
     */
    protected function redirectToDashboard($message)
    {
        return redirect()->route('chefs.dashboard.index')->with('success', $message);
    }
}
