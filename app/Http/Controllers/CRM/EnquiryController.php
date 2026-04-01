<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    // For the Admin Panel (Backend)
    public function index()
    {
        $enquiries = Enquiry::latest()->paginate(15);
        return view('crm.enquiries.index', compact('enquiries'));
    }

    // For the Public Contact Page (Frontend)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'website' => 'nullable|url',
            'message' => 'required|string',
        ]);

        Enquiry::create($validated);

        return back()->with('success', 'Your message has been sent successfully!');
    }

    public function destroy($id)
    {
        Enquiry::findOrFail($id)->delete();
        return back()->with('success', 'Enquiry deleted.');
    }
}