<?php

namespace App\Http\Middleware\capture;

use Closure;

class CheckCaptureShow
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if ($request->user()->cannot('show captures')) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
