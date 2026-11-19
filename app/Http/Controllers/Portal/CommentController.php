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
use Illuminate\Support\Str;

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
            $destinationDir = storage_path('app/public/comments');
            if (!file_exists($destinationDir)) {
                mkdir($destinationDir, 0755, true);
            }

            foreach ($request->file('attachments') as $file) {
                $extension = $file->getClientOriginalExtension() ?: 'bin';
                $filename = Str::random(40) . '.' . $extension;
                $file->move($destinationDir, $filename);
                $path = 'comments/' . $filename;
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

    public function destroy(string $id)
    {
        $comment = Comment::findOrFail($id);

        $user = Auth::user();
        $userRole = $user->role->name ?? '';

        // Allow deletion if the user is the author OR is Admin / Manager
        $isAuthor = (int)$comment->user_id === (int)$user->id;
        $isStaff  = in_array($userRole, ['Admin', 'Manager']);

        if (!$isAuthor && !$isStaff) {
            abort(403, 'You do not have permission to delete this comment.');
        }

        // Prevent non-admins from deleting status changes
        if ($comment->type === 'status_change' && $userRole !== 'Admin') {
            abort(403, 'System status records cannot be deleted.');
        }

        // Delete physical attachment files if they exist
        if (!empty($comment->attachments) && is_array($comment->attachments)) {
            foreach ($comment->attachments as $file) {
                if (!empty($file['path'])) {
                    $cleanPath = ltrim(str_replace(['../', '..\\'], '', $file['path']), '/\\');
                    $fullPath  = storage_path('app/public/' . $cleanPath);
                    if (file_exists($fullPath) && is_file($fullPath)) {
                        @unlink($fullPath);
                    }
                }
            }
        }

        $comment->delete();

        return back()->with('success', 'Comment deleted successfully.');
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
