<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;

class VerifyLinkValidity
{
    public function handle(Request $request, Closure $next)
    {

        $link = $request->route('link');


        $user = User::where('link', $link)
            ->where('link_expires_at', '>', now())
            ->first();

        if (!$user) {
            return redirect('/');
        }

        return $next($request);
    }
}
