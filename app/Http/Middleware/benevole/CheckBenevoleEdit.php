<?php

namespace App\Http\Middleware\benevole;

use Closure;

class CheckBenevoleEdit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if ($request->user()->cannot('edit benevole')) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
