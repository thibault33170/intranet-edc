<?php

namespace App\Http;

use App\Http\Middleware\benevole\CheckBenevoleEdit;
use App\Http\Middleware\benevole\CheckBenevoleIndex;
use App\Http\Middleware\benevole\CheckBenevoleShow;
use App\Http\Middleware\capture\CheckCaptureEdit;
use App\Http\Middleware\capture\CheckCaptureIndex;
use App\Http\Middleware\capture\CheckCaptureShow;
use App\Http\Middleware\cat\CheckCatEdit;
use App\Http\Middleware\cat\CheckCatIndex;
use App\Http\Middleware\cat\CheckCatShow;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\TrustProxies::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'benevole.index' => CheckBenevoleIndex::class,
        'capture.index' => CheckCaptureIndex::class,
        'cat.index' => CheckCatIndex::class,
        'benevole.show' => CheckBenevoleShow::class,
        'capture.show' => CheckCaptureShow::class,
        'cat.show' => CheckCatShow::class,
        'benevole.edit' => CheckBenevoleEdit::class,
        'capture.edit' => CheckCaptureEdit::class,
        'cat.edit' => CheckCatEdit::class,
    ];
}
