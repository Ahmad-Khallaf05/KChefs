<?php
namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the contact entries.
     */
    public function index()
    {
        return view('home.contacts');
    }

    /**
     * Display the specified contact entry.
     */
    public function show($id)
    {
        $contact = ContactUs::find($id);

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
        
        $request->validate([
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        $contact = ContactUs::create($request->all());

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }


    /**
     * Remove the specified contact entry from the database.
     */
    public function delete($id)
    {
        $contact = ContactUs::find($id);

        if (!$contact) {
            return response()->json(['message' => 'Contact entry not found'], 404);
        }

        $contact->delete();
        return response()->json(['message' => 'Contact entry deleted successfully']);
    }
}
