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
        'Testimonial_Title' => 'required|string',
        'testimonial' => 'required|string'
    ]);

    // Use Eloquent to create a new testimonial entry
    try {
        Testimonial::create([
            'user_name' => $request->input('user_name'),
            'user_email' => $request->input('user_email'),
            'Testimonial_Title' => $request->input('Testimonial_Title'),
            'testimonial' => $request->input('testimonial')
        ]);
       
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Your testimonial has been submitted successfully!');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Something went wrong. Please try again.');
    }
}


     /**
     * Remove the specified contact entry from the database.
     */
    public function delete($id)
    {
        $contact = Testimonial::find($id);

        if (!$contact) {
            return response()->json(['message' => 'Testimonial entry not found'], 404);
        }

        $contact->delete();
        return response()->json(['message' => 'Testimonial entry deleted successfully']);
    }
    

}
