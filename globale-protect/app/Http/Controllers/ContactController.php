<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        // Store the message in the database
        ContactMessage::create($validated);

        // Send email notification (optional - configure mail settings)
        try {
            // Mail::to('admin@globaleprotect.com')->send(new ContactFormSubmitted($validated));
        } catch (\Exception $e) {
            // Log error but don't fail the form submission
            \Log::error('Failed to send contact form email: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Thank you for your message. We will get back to you soon!');
    }
}
