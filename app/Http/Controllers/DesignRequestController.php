<?php

namespace App\Http\Controllers;

use App\Mail\ClientProjectAssignedMail;
use App\Mail\DesignerAssignedMail;
use App\Mail\NewRequestMail;
use App\Models\DesignRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class DesignRequestController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title'          => 'required|string|max:255',
            'request_type'   => 'required|string',
            'cabinet_brand'  => 'required|string|max:255',
            'door_style'     => 'required|string|max:255',
            'finish'         => 'required|string|max:255',
            'attachments'    => 'nullable|array',
            'attachments.*'  => 'file|max:10240', // 10 MB per file
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
            'title'              => $request->title,
            'client_id'          => Auth::id() ?? null,
            'status'             => 'Queued',
            'request_type'       => $request->request_type,
            'cabinet_brand'      => $request->cabinet_brand,
            'door_style'         => $request->door_style,
            'finish'             => $request->finish,
            'ceiling_height'     => $request->ceiling_height,
            'wall_cabinet_height'=> $request->wall_cabinet_height,
            'expected_date'      => $request->expected_date,
            'additional_notes'   => $request->additional_notes,
            'attachments'        => $attachments,
            'additional_info'    => $request->input('additional_info', []),
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
            try {
                Mail::to($recipient->email)->send(new NewRequestMail($designRequest));
            } catch (\Exception $e) {
                Log::error('NewRequestMail failed to ' . $recipient->email . ': ' . $e->getMessage());
            }
        }

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Request submitted successfully!', 'data' => $designRequest]);
        }

        return redirect()->route('portal.dashboard')->with('success', 'Your request has been submitted successfully!');
    }

    public function assign(Request $request, string $id)
    {
        $userRole = Auth::user()->role->name ?? '';
        if (!in_array($userRole, ['Admin', 'Manager'])) {
            return back()->with('error', 'You are not allowed to assign designers.');
        }

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

        try {
            Mail::to($designer->email)->send(new DesignerAssignedMail($designRequest, $designer));
        } catch (\Exception $e) {
            Log::error('DesignerAssignedMail failed to ' . $designer->email . ': ' . $e->getMessage());
        }

        $clientEmail = $designRequest->client->email ?? $designRequest->email ?? null;
        if ($clientEmail) {
            try {
                Mail::to($clientEmail)->send(new ClientProjectAssignedMail($designRequest));
            } catch (\Exception $e) {
                Log::error('ClientProjectAssignedMail failed to ' . $clientEmail . ': ' . $e->getMessage());
            }
        }

        return back()->with('success', 'Request assigned to ' . $designer->name . ' successfully.');
    }

    public function prioritize(string $id)
    {
        $designRequest = DesignRequest::findOrFail($id);
        $designRequest->update(['is_prioritized' => !$designRequest->is_prioritized]);

        $message = $designRequest->is_prioritized
            ? 'Request marked as prioritized.'
            : 'Request removed from prioritized.';

        return back()->with('success', $message);
    }
}
