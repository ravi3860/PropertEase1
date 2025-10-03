<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ContactRequest;

class AgentController extends Controller
{
    // 📌 Get all agents
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return response()->json(Agent::with('user')->get());
        }

        $agent = Agent::with('user')->where('user_id', $user->id)->first();
        if (!$agent) {
            return response()->json(['message' => 'Agent not found'], 404);
        }

        return response()->json($agent);
    }

    // 📌 Get a single agent
    public function show($id)
    {
        $user = Auth::user();
        $agent = Agent::with('user')->findOrFail($id);

        if ($user->role !== 'admin' && $agent->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($agent);
    }

    // 📌 Update agent details
    public function update(Request $request)
    {
        $user = $request->user();
        $agent = Agent::where('user_id', $user->id)->firstOrFail();
        if ($agent->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'phone' => 'nullable|string',
            'license_number' => 'nullable|string|max:255',
            'agency_name' => 'nullable|string|max:255',
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
        ]);

        $agent->update($request->only(['phone', 'license_number', 'agency_name']));

        if ($request->has('name') || $request->has('email')) {
            $agent->user->update($request->only(['name', 'email']));
        }
        if (!$request->bearerToken()) {
            return redirect()->route('agent.dashboard')->with('success', 'Profile updated successfully.');
        }
        return response()->json([
            'message' => 'Agent updated successfully',
            'agent' => $agent->load('user')
        ]);
    }

    // 📌 Delete an agent
    public function destroy($id)
    {
        $user = Auth::user();
        $agent = Agent::findOrFail($id);

        if ($user->role !== 'admin' && $agent->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $agent->delete();

        return response()->json(['message' => 'Agent deleted successfully']);
    }

    public function dashboard()
    {
        // find the agent row using the logged-in user's id
        $agent = Agent::where('user_id', Auth::id())->first();

        // if no agent record found, redirect back or abort - adjust to preference
        if (! $agent) {
           return redirect()->route('home')->with('error', 'Agent profile not found.');
           }

          // Fetch all requests for this agent
        $requests = ContactRequest::with('member.user')
        ->where('agent_id', $agent->id)
        ->orderBy('created_at', 'desc')
        ->get();

        // return blade: resources/views/dashboards/agent.blade.php
        return view('agent.dashboard', compact('agent', 'requests'));
    }
}
