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
        $contacts = ContactUs::all(); // Fetch all contacts
        return view('dashboard.contacts.index', compact('contacts'));
    }

    public function userindex()
    {
        $contacts = ContactUs::all(); // Fetch all contacts
        return view('home.contacts', compact('contacts'));
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

        return view('dashboard.contacts.show', compact('contact'));
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

     public function destroy($id)
     {
         $contact = ContactUs::find($id);
 
         if (!$contact) {
            return redirect()->route('contacts.dashboard.index')->with('error', 'Contact entry not found');
         }
 
         $contact->delete();
         return redirect()->route('contacts.dashboard.index')->with('success', 'Contact entry deleted successfully');
     }


    public function delete($id)
    {
        $contact = ContactUs::find($id);
    
        if (!$contact) {
            return redirect()->route('dashboard.contacts.userindex')->with('error', 'Contact entry not found');
        }
    
        $contact->delete();
    
        // Redirect to the contact show page after deletion
        return redirect()->route('dashboard.contacts.userindex')->with('success', 'Contact entry deleted successfully');
    }
    
   

}
