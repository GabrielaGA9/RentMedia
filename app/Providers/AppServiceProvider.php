<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\View;
use Inertia\Inertia;
class RouteServiceProvider extends ServiceProvider
{
    /**
     * This is where users will be redirected after login.
     */
    public const HOME = '/redirect-by-role';

    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot(): void
{
    Inertia::share([
        'auth' => fn () => [
            'user' => auth()->user(),
        ],
    ]);
}
}
