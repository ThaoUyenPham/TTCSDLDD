<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append:[
            App\Http\Middleware\LocalizationMiddleware::class,
            \Illuminate\Http\Middleware\HandleCors::class,
        ]);
        $middleware->alias([
            'load.category.client'=>    App\Http\Middleware\LoadCategoriesForClient::class,
            // 'auth.admin'=>  App\Http\Middleware\CheckAdminMiddleware::class,
            'auth.checklogin'=>  App\Http\Middleware\CheckLoginMiddleware::class,
            'role' => \App\Http\Middleware\RolePermissionMiddleware::class,
            'showmenu'=> \App\Http\Middleware\ShowMenuMiddleware::class
         ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
