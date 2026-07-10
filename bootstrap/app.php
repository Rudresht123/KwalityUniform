<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->validateCsrfTokens(except: [
            'partnership/school',
            'partnership/vendor',
        ]);

        $middleware->redirectUsersTo(function (Request $request) {
            $user = $request->user();
            if (!$user) return route('login');

            if ($user->hasAnyRole(['Super Admin', 'Admin'])) {
                return route('dashboard');
            }
            if ($user->hasRole('School')) {
                return route('school.distribution');
            }

            return route('website.shop');
        });

        $middleware->alias([
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (\Spatie\Permission\Exceptions\UnauthorizedException $e, Request $request) {
            $user = $request->user();
            $fallback = route('website.shop');

            if ($user) {
                if ($user->hasAnyRole(['Super Admin', 'Admin'])) {
                    $fallback = route('dashboard');
                } elseif ($user->hasRole('School')) {
                    $fallback = route('school.distribution');
                }
            }

            return redirect($fallback)->with('error', 'You do not have the required permissions to access this page.');
        });

        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
        );
    })->create();
