<?php

namespace App\Http\Middleware\cat;

use Closure;

class CheckCatIndex
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if ($request->user()->cannot('display cats')) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
