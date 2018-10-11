<?php

namespace App\Http\Middleware\benevole;

use Closure;

class CheckBenevoleIndex
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if ($request->user()->cannot('display benevoles')) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
