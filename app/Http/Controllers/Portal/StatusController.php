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
    private const CLIENT_STATUSES   = ['Information Submitted', 'Approved', 'Revision Requested', 'Design Error', 'Project Completed', 'Closed'];
    private const MANAGER_STATUSES  = ['In Progress', 'Needs Information', 'To Be Continued', 'Needs Approval'];
    private const DESIGNER_STATUSES = ['In Progress', 'Needs Information', 'Needs Approval', 'To Be Continued'];
    private const ADMIN_STATUSES    = ['Queued', 'Assigned', 'In Progress', 'Needs Information', 'Information Submitted', 'To Be Continued', 'Needs Approval', 'Revision Requested', 'Design Error', 'Approved', 'Project Completed'];

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Queued,Assigned,In Progress,Needs Information,Information Submitted,To Be Continued,Needs Approval,Revision Requested,Design Error,Approved,Project Completed,Closed',
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
        $this->authorizeClientRequest($designRequest);
        $oldStatus     = $designRequest->status;

        // Designer and Manager cannot change status while awaiting client approval
        if ($oldStatus === 'Needs Approval' && in_array($userRole, ['Designer', 'Manager'])) {
            return back()->with('error', 'Status is locked at "Needs Approval". Waiting for client to approve, request revision, or report a design error.');
        }

        // Designer and Manager have restricted transitions based on current status
        if (in_array($userRole, ['Designer', 'Manager'])) {
            $transitionMap = [
                'Assigned'             => ['In Progress', 'Needs Information'],
                'In Progress'          => ['Needs Information', 'Needs Approval', 'To Be Continued'],
                'Needs Information'    => ['In Progress'],
                'Information Submitted'=> ['In Progress'],
                'Revision Requested'   => ['In Progress', 'Needs Information'],
                'Design Error'         => ['In Progress', 'Needs Information'],
            ];
            if (isset($transitionMap[$oldStatus]) && !in_array($newStatus, $transitionMap[$oldStatus])) {
                return back()->with('error', 'That status transition is not allowed from "' . $oldStatus . '".');
            }
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

        $managers = User::whereHas('role', fn($q) => $q->where('name', 'Manager'))
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
            case 'Closed':
                foreach ($managers as $manager) {
                    $this->send($manager->email, new RequestClosedMail($designRequest));
                }
                if ($clientEmail) {
                    $this->send($clientEmail, new RequestClosedMail($designRequest));
                }
                break;
        }
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

    private function send(string $email, object $mailable): void
    {
        try {
            Mail::to($email)->send($mailable);
        } catch (\Exception $e) {
            Log::error(get_class($mailable) . ' failed to ' . $email . ': ' . $e->getMessage());
        }
    }
}
