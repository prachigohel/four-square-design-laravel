<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Mail\AdditionalChangesMail;
use App\Mail\DesignErrorMail;
use App\Mail\InfoSubmittedMail;
use App\Mail\NeedsApprovalManagerMail;
use App\Mail\NeedsApprovalMail;
use App\Mail\NeedsInfoClientMail;
use App\Mail\NeedsInfoManagerMail;
use App\Mail\ProjectApprovedMail;
use App\Mail\RequestClosedMail;
use App\Mail\RevisionRequestedMail;
use App\Mail\StatusWipClientMail;
use App\Mail\StatusWipManagerMail;
use App\Mail\ToBeContinuedMail;
use App\Models\Comment;
use App\Models\DesignRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class StatusController extends Controller
{
    // Statuses each role is allowed to set
    private const CLIENT_STATUSES   = ['Information Submitted', 'Approved', 'Revision Requested', 'Design Error', 'Project Completed'];
    private const MANAGER_STATUSES  = ['In Progress', 'Needs Information', 'To Be Continued', 'Needs Approval'];
    private const DESIGNER_STATUSES = ['In Progress', 'Needs Information', 'Needs Approval', 'To Be Continued'];
    private const ADMIN_STATUSES    = ['Queued', 'Assigned', 'In Progress', 'Needs Information', 'Information Submitted', 'To Be Continued', 'Needs Approval', 'Revision Requested', 'Design Error', 'Approved', 'Project Completed'];

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Queued,Assigned,In Progress,Needs Information,Information Submitted,To Be Continued,Needs Approval,Revision Requested,Design Error,Approved,Project Completed',
        ]);

        $userRole  = Auth::user()->role->name ?? '';
        $newStatus = $request->status;

        $allowed = match ($userRole) {
            'Client'   => self::CLIENT_STATUSES,
            'Manager'  => self::MANAGER_STATUSES,
            'Designer' => self::DESIGNER_STATUSES,
            'Admin'    => self::ADMIN_STATUSES,
            default    => [],
        };

        if (!in_array($newStatus, $allowed)) {
            return back()->with('error', 'You are not allowed to set this status.');
        }

        $designRequest = DesignRequest::with('client', 'designer')->findOrFail($id);
        $oldStatus     = $designRequest->status;

        // Designer and Manager cannot change status while awaiting client approval
        if ($oldStatus === 'Needs Approval' && in_array($userRole, ['Designer', 'Manager'])) {
            return back()->with('error', 'Status is locked at "Needs Approval". Waiting for client to approve, request revision, or report a design error.');
        }

        if ($oldStatus === $newStatus) {
            return back()->with('info', 'Status is already set to ' . $newStatus . '.');
        }

        $designRequest->update(['status' => $newStatus]);

        Comment::create([
            'design_request_id' => $id,
            'user_id'           => Auth::id(),
            'message'           => "Status changed from \"{$oldStatus}\" to \"{$newStatus}\".",
            'attachments'       => [],
            'type'              => $newStatus === 'Revision Requested' ? 'revision' : 'status_change',
        ]);

        $clientEmail   = $designRequest->client->email ?? $designRequest->email ?? null;
        $designerEmail = $designRequest->designer->email ?? null;

        $managers = User::whereHas('role', fn($q) => $q->whereIn('name', ['Admin', 'Manager']))
            ->get()
            ->unique('email');

        $this->dispatchEmails($newStatus, $designRequest, $clientEmail, $designerEmail, $managers);

        return back()->with('success', "Status updated to \"{$newStatus}\" successfully.");
    }

    private function dispatchEmails(string $status, DesignRequest $designRequest, ?string $clientEmail, ?string $designerEmail, $managers): void
    {
        switch ($status) {
            case 'In Progress':
                foreach ($managers as $manager) {
                    $this->send($manager->email, new StatusWipManagerMail($designRequest));
                }
                if ($clientEmail) {
                    $this->send($clientEmail, new StatusWipClientMail($designRequest));
                }
                break;

            case 'Needs Information':
                if ($clientEmail) {
                    $this->send($clientEmail, new NeedsInfoClientMail($designRequest));
                }
                foreach ($managers as $manager) {
                    $this->send($manager->email, new NeedsInfoManagerMail($designRequest));
                }
                break;

            case 'Information Submitted':
                foreach ($managers as $manager) {
                    $this->send($manager->email, new InfoSubmittedMail($designRequest));
                }
                if ($designerEmail) {
                    $this->send($designerEmail, new InfoSubmittedMail($designRequest));
                }
                break;

            case 'Needs Approval':
                if ($clientEmail) {
                    $this->send($clientEmail, new NeedsApprovalMail($designRequest));
                }
                foreach ($managers as $manager) {
                    $this->send($manager->email, new NeedsApprovalManagerMail($designRequest));
                }
                break;

            case 'Revision Requested':
                if ($designerEmail) {
                    $this->send($designerEmail, new RevisionRequestedMail($designRequest));
                }
                foreach ($managers as $manager) {
                    $this->send($manager->email, new RevisionRequestedMail($designRequest));
                }
                break;

            case 'Design Error':
                if ($designerEmail) {
                    $this->send($designerEmail, new DesignErrorMail($designRequest));
                }
                foreach ($managers as $manager) {
                    $this->send($manager->email, new DesignErrorMail($designRequest));
                }
                break;

            case 'To Be Continued':
                if ($clientEmail) {
                    $this->send($clientEmail, new ToBeContinuedMail($designRequest));
                }
                foreach ($managers as $manager) {
                    $this->send($manager->email, new ToBeContinuedMail($designRequest));
                }
                break;

            case 'Approved':
                if ($designerEmail) {
                    $this->send($designerEmail, new ProjectApprovedMail($designRequest));
                }
                foreach ($managers as $manager) {
                    $this->send($manager->email, new ProjectApprovedMail($designRequest));
                }
                break;

            case 'Project Completed':
                foreach ($managers as $manager) {
                    $this->send($manager->email, new RequestClosedMail($designRequest));
                }
                if ($clientEmail) {
                    $this->send($clientEmail, new RequestClosedMail($designRequest));
                }
                break;
        }
    }

    private function send(string $email, object $mailable): void
    {
        try {
            Mail::to($email)->send($mailable);
        } catch (\Exception $e) {
            Log::error(get_class($mailable) . ' failed to ' . $email . ': ' . $e->getMessage());
        }
    }
}
