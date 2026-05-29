<?php

namespace App\Http\Controllers;

use App\Mail\NewLeadMail;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        $contact = Contact::create($request->only(['name', 'email', 'message']));

        $recipients = User::whereHas('role', fn($q) => $q->whereIn('name', ['Admin', 'Manager']))
            ->get()
            ->unique('email');

        foreach ($recipients as $recipient) {
            Mail::to($recipient->email)->send(new NewLeadMail($contact));
        }

        return back()->with('success', 'Your message has been sent successfully!');
    }
}
