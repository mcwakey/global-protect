<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = ContactMessage::orderBy('created_at', 'desc');

        if ($request->get('filter') === 'unread') {
            $query->unread();
        }

        $messages = $query->paginate(10);
        $unreadCount = ContactMessage::unread()->count();

        return view('admin.contact-messages.index', compact('messages', 'unreadCount'));
    }

    /**
     * Display the specified resource.
     */
    public function show(ContactMessage $contactMessage)
    {
        // Mark as read when viewing
        if (!$contactMessage->is_read) {
            $contactMessage->markAsRead();
        }

        return view('admin.contact-messages.show', compact('contactMessage'));
    }

    /**
     * Mark message as read.
     */
    public function markAsRead(ContactMessage $contactMessage)
    {
        $contactMessage->markAsRead();

        return redirect()->back()->with('success', 'Message marked as read.');
    }

    /**
     * Mark message as unread.
     */
    public function markAsUnread(ContactMessage $contactMessage)
    {
        $contactMessage->markAsUnread();

        return redirect()->back()->with('success', 'Message marked as unread.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();

        return redirect()->route('admin.contact-messages.index')
            ->with('success', 'Message deleted successfully.');
    }
}
