<?php

namespace App\Http\Middleware\capture;

use Closure;

class CheckCaptureEdit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if ($request->user()->cannot('edit capture')) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
