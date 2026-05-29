<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Mail\NeedsApprovalMail;
use App\Mail\RequestClosedMail;
use App\Models\Comment;
use App\Models\DesignRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class StatusController extends Controller
{
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Open,Assigned,WIP,Needs Information,Needs Approval,Closed',
        ]);

        $designRequest = DesignRequest::with('client', 'designer')->findOrFail($id);
        $oldStatus = $designRequest->status;
        $newStatus = $request->status;

        if ($oldStatus === $newStatus) {
            return back()->with('info', 'Status is already set to ' . $newStatus . '.');
        }

        $designRequest->update(['status' => $newStatus]);

        Comment::create([
            'design_request_id' => $id,
            'user_id' => Auth::id(),
            'message' => "Status changed from \"{$oldStatus}\" to \"{$newStatus}\".",
            'attachments' => [],
            'type' => 'status_change',
        ]);

        if ($newStatus === 'Needs Approval') {
            $clientEmail = $designRequest->client->email ?? $designRequest->email;
            if ($clientEmail) {
                Mail::to($clientEmail)->send(new NeedsApprovalMail($designRequest));
            }
        }

        if ($newStatus === 'Closed') {
            $recipients = User::whereHas('role', fn($q) => $q->whereIn('name', ['Admin', 'Manager']))
                ->get()
                ->unique('email');

            foreach ($recipients as $recipient) {
                Mail::to($recipient->email)->send(new RequestClosedMail($designRequest));
            }
        }

        return back()->with('success', "Status updated to \"{$newStatus}\" successfully.");
    }
}
