<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Mail\ClientResponseMail;
use App\Models\Comment;
use App\Models\DesignRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    public function store(Request $request, string $requestId)
    {
        $request->validate([
            'message' => 'required|string',
            'attachments.*' => 'nullable|file|max:10240', // 10MB limit
        ]);

        $designRequest = DesignRequest::with('client', 'designer')->findOrFail($requestId);

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
            'message' => $request->message,
            'attachments' => $attachments,
            'type' => 'comment',
        ]);

        // When client responds on a "Needs Approval" request, notify the designer
        $userRole = Auth::user()->role->name ?? '';
        if ($designRequest->status === 'Needs Approval' && $userRole === 'Client') {
            if ($designRequest->designer && $designRequest->designer->email) {
                Mail::to($designRequest->designer->email)->send(new ClientResponseMail($designRequest, $comment));
            }
        }

        return back()->with('success', 'Comment posted successfully.');
    }
}
