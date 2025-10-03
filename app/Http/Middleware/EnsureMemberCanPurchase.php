<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureMemberCanPurchase
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        if (! $user || ! $user->member) {
            return response()->json(['message' => 'Only members can perform this action.'], 403);
        }

        return $next($request);
    }
}
