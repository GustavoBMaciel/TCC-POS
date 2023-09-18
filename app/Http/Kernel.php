<?php

namespace App\Http;

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
        \App\Http\Middleware\CheckForMaintenanceMode::class,
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
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'convenios' => \App\Http\Middleware\Convenios::class,
        'fornecedores' => \App\Http\Middleware\Fornecedores::class,
        'exames' => \App\Http\Middleware\Exames::class,
        'medicamentos' => \App\Http\Middleware\Medicamentos::class,
        'statusagenda' => \App\Http\Middleware\Statusagenda::class,
        'tiposagendamento' => \App\Http\Middleware\Tiposagendamento::class,
        'profissoes' => \App\Http\Middleware\Profissoes::class,
        'anamneses' => \App\Http\Middleware\Anamneses::class,
        'agendamentos' => \App\Http\Middleware\Agendamentos::class,
        'alteraragendamentos' => \App\Http\Middleware\Alteraragendamentos::class,
        'excluiragendamentos' => \App\Http\Middleware\Excluiragendamentos::class,
        'proximaconsulta' => \App\Http\Middleware\Proximaconsulta::class,
        'consultapaciente' => \App\Http\Middleware\Consultapaciente::class,
        'caixa' => \App\Http\Middleware\Caixa::class,
        'receber' => \App\Http\Middleware\Receber::class,
        'pagar' => \App\Http\Middleware\Pagar::class,
    ];
}



