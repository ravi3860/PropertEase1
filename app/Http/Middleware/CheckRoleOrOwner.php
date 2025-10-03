<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Member;
use App\Models\Agent;

class CheckRoleOrOwner
{
    /**
     * Handle an incoming request.
     *
     * Admin: Full access
     * Member/Agent: Only their own profile
     */
    public function handle(Request $request, Closure $next, $role = null)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        // ✅ Admin has full access
        if ($user->role === 'admin') {
            return $next($request);
        }

        // ✅ Member route protection
        if ($request->is('api/members/*')) {
            $member = Member::where('user_id', $user->id)->first();
            if (!$member || $member->id != $request->route('id')) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
        }

        // ✅ Agent route protection
        if ($request->is('api/agents/*')) {
            $agent = Agent::where('user_id', $user->id)->first();
            if (!$agent || $agent->id != $request->route('id')) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
        }

        return $next($request);
    }
}
