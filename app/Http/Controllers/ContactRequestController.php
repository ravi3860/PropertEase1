<?php

namespace App\Http\Controllers;

use App\Models\ContactRequest;
use App\Models\Member;
use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactRequestController extends Controller
{
    /**
     * Store a new contact request (member action).
     */
    public function store(Request $request)
    {
        $request->validate([
            'agent_id' => 'required|exists:agents,id',
            'message' => 'required|string|max:1000',
            'type' => 'required|in:visit,general',
        ]);

        $member = Auth::user()->member;

        $contactRequest = ContactRequest::create([
            'member_id' => $member->id,
            'agent_id' => $request->agent_id,
            'message' => $request->message,
            'type' => $request->type,
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'Contact request sent successfully.',
            'data' => $contactRequest
        ], 201);
    }

    /**
     * List requests made by the authenticated member.
     */
    public function myRequests(Request $request)
    {
        $member = Auth::user()->member;

        $requests = ContactRequest::with('agent')
            ->where('member_id', $member->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($requests);
    }

    /**
     * List all requests received by the authenticated agent.
     */
    public function agentRequests(Request $request)
    {
        $agent = Auth::user()->agent;

        $requests = ContactRequest::with('member')
            ->where('agent_id', $agent->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($requests);
    }

    /**
     * Update request status (accept/decline) by agent.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:accepted,declined',
        ]);

        $agent = Auth::user()->agent;

        $contactRequest = ContactRequest::where('id', $id)
            ->where('agent_id', $agent->id)
            ->firstOrFail();

        $contactRequest->status = $request->status;
        $contactRequest->save();

        return redirect()->back()->with('success', "Request has been {$contactRequest->status}.");
    }

}
