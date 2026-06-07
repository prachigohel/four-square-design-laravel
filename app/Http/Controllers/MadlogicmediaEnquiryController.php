<?php

namespace App\Http\Controllers;

use App\Models\MadlogicmediaEnquiry;
use Illuminate\Http\Request;

class MadlogicmediaEnquiryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|email|max:255',
            'phone_number'     => 'nullable|string|max:20',
            'service_required' => 'nullable|string|max:255',
            'message'          => 'required|string',
        ]);

        MadlogicmediaEnquiry::create($request->only([
            'name',
            'email',
            'phone_number',
            'service_required',
            'message',
        ]));

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Your enquiry has been submitted successfully!');
    }

    public function index()
    {
        $enquiries = MadlogicmediaEnquiry::latest()->paginate(20);

        return view('enquiries.index', compact('enquiries'));
    }
}
