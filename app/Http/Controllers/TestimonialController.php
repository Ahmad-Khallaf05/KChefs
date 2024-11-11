<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the contact entries.
     */
    public function index()
    {
        
    }

     /**
     * Display the specified contact entry.
     */
    public function show($id)
    {
        $contact = Testimonial::find($id);

        if (!$contact) {
            return response()->json(['message' => 'Contact entry not found'], 404);
        }

        return response()->json($contact);
    }

     /**
     * Store a newly created contact entry in the database.
     */
    public function store(Request $request)
{
    // Validate incoming request data
    $request->validate([
        'user_name' => 'required|string|max:255',
        'user_email' => 'required|email|max:255',
        'testimonial' => 'required|string'
    ]);

    // Use Eloquent to create a new testimonial entry
    try {
        Testimonial::create([
            'user_name' => $request->input('user_name'),
            'user_email' => $request->input('user_email'),
            'testimonial' => $request->input('testimonial')
        ]);
        return redirect()->back()->with('success', 'Your testimonial has been submitted successfully!');
    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => 'Error saving testimonial: ' . $e->getMessage()]);
    }
}


     /**
     * Remove the specified contact entry from the database.
     */
    public function delete($id)
    {
        $contact = Testimonial::find($id);

        if (!$contact) {
            return response()->json(['message' => 'Contact entry not found'], 404);
        }

        $contact->delete();
        return response()->json(['message' => 'Contact entry deleted successfully']);
    }
    

}
