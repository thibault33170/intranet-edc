<?php

namespace App\Http\Middleware\cat;

use Closure;

class CheckCatShow
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if ($request->user()->cannot('show cats')) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
