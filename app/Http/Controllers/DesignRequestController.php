<?php

namespace App\Http\Controllers;

use App\Mail\DesignerAssignedMail;
use App\Mail\NewRequestMail;
use App\Models\DesignRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class DesignRequestController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'project_type' => 'nullable|string',
        ]);

        $attachments = [];
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('attachments', 'public');
                $attachments[] = [
                    'name' => $file->getClientOriginalName(),
                    'path' => $path,
                ];
            }
        }

        $designRequest = DesignRequest::create([
            'title' => 'Project Inquiry: ' . ($request->project_type ?? 'New Project'),
            'client_id' => Auth::id() ?? null,
            'status' => 'Open',
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'project_type' => $request->project_type,
            'scope' => $request->scope,
            'door_style' => $request->door_style,
            'refrigerator' => $request->refrigerator,
            'range_cooktop' => $request->range_cooktop,
            'ventilation' => $request->ventilation,
            'dishwasher' => $request->dishwasher,
            'cabinet_brand' => $request->cabinet_brand,
            'ceiling_height' => $request->ceiling_height,
            'wall_cabinet_height' => $request->wall_cabinet_height,
            'expected_date' => $request->expected_date,
            'additional_notes' => $request->additional_notes,
            'attachments' => $attachments,
            'additional_info' => $request->except(['attachments', '_token']),
        ]);

        // Load relationships for email
        $designRequest->load('client');

        // Notify admins and the client's manager
        $recipients = User::whereHas('role', fn($q) => $q->where('name', 'Admin'))->get();

        if ($designRequest->client && $designRequest->client->manager_id) {
            $manager = User::find($designRequest->client->manager_id);
            if ($manager) {
                $recipients = $recipients->push($manager)->unique('email');
            }
        } else {
            $managers = User::whereHas('role', fn($q) => $q->where('name', 'Manager'))->get();
            $recipients = $recipients->merge($managers)->unique('email');
        }

        foreach ($recipients as $recipient) {
            Mail::to($recipient->email)->send(new NewRequestMail($designRequest));
        }

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Request submitted successfully!', 'data' => $designRequest]);
        }

        return redirect()->back()->with('success', 'Your project request has been submitted successfully! We will contact you soon.');
    }

    public function assign(Request $request, string $id)
    {
        $request->validate([
            'designer_id' => 'required|exists:users,id',
        ]);

        $designRequest = DesignRequest::with('client')->findOrFail($id);
        $designer = User::findOrFail($request->designer_id);

        $designRequest->update([
            'designer_id' => $designer->id,
            'status' => 'Assigned',
        ]);

        $designRequest->refresh()->load('designer');

        Mail::to($designer->email)->send(new DesignerAssignedMail($designRequest, $designer));

        return back()->with('success', 'Request assigned to ' . $designer->name . ' successfully.');
    }
}
