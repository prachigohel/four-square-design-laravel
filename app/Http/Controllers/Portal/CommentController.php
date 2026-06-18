<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Mail\CommentNotificationMail;
use App\Models\Comment;
use App\Models\DesignRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    public function store(Request $request, string $requestId)
    {
        $request->validate([
            'message'       => 'nullable|string',
            'attachments.*' => 'nullable|file|max:102400',
        ]);

        if (empty(trim($request->message ?? '')) && !$request->hasFile('attachments')) {
            return back()->withErrors(['message' => 'Please add a comment or attach a file.']);
        }

        $designRequest = DesignRequest::with('client', 'designer')->findOrFail($requestId);
        $this->authorizeClientRequest($designRequest);

        $attachments = [];
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('comments', 'public');
                $attachments[] = [
                    'name' => $file->getClientOriginalName(),
                    'path' => $path,
                ];
            }
        }

        $comment = Comment::create([
            'design_request_id' => $requestId,
            'user_id' => Auth::id(),
            'message' => $request->message ?? '',
            'attachments' => $attachments,
            'type' => 'comment',
        ]);

        $userRole = Auth::user()->role->name ?? '';

        if ($userRole === 'Client') {
            // Client commented → notify the assigned designer
            if ($designRequest->designer && $designRequest->designer->email) {
                try {
                    Mail::to($designRequest->designer->email)
                        ->send(new CommentNotificationMail($designRequest, $comment, $designRequest->designer->name));
                } catch (\Throwable $e) {
                    Log::error('CommentNotificationMail to designer failed: ' . $e->getMessage());
                }
            }
        } else {
            // Designer / Admin / Manager commented → notify the client
            $clientEmail = $designRequest->client->email ?? $designRequest->email ?? null;
            $clientName  = $designRequest->client->name ?? 'Client';
            if ($clientEmail) {
                try {
                    Mail::to($clientEmail)
                        ->send(new CommentNotificationMail($designRequest, $comment, $clientName));
                } catch (\Throwable $e) {
                    Log::error('CommentNotificationMail to client failed: ' . $e->getMessage());
                }
            }
        }

        return back()->with('success', 'Comment posted successfully.');
    }

    private function authorizeClientRequest(DesignRequest $designRequest): void
    {
        $user = Auth::user();
        if (($user->role->name ?? '') !== 'Client') {
            return;
        }
        if ($user->company_role === 'manager' && $user->company_name) {
            abort_unless(
                $designRequest->client && $designRequest->client->company_name === $user->company_name,
                403
            );
        } else {
            abort_unless($designRequest->client_id === $user->id, 403);
        }
    }
}
