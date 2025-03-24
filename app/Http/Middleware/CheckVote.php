<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Vote;

class CheckVote
{
    public function handle(Request $request, Closure $next)
    {
        if (Vote::where('user_id', Auth::id())->exists()) {
            return redirect()->route('vote.index')->with('error', 'You have already voted!');
        }
        return $next($request);
    }
}

