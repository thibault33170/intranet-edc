<?php

namespace App\Http\Middleware\benevole;

use Closure;

class CheckBenevoleShow
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if ($request->user()->cannot('show benevoles')) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
