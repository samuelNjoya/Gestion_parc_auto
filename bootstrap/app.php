<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AuthCommonMiddleware;
use App\Http\Middleware\ComptableMiddleware;
use App\Http\Middleware\ConducteurMiddleware;
use App\Http\Middleware\GestionnaireMiddleware;
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
         $middleware->alias([
           'common' => AuthCommonMiddleware::class,
        //    'admin' => AdminMiddleware::class,
        //    'gestionnaire' => GestionnaireMiddleware::class,
        //    'comptable' => ComptableMiddleware::class,
        //    'conducteur' => ConducteurMiddleware::class,

        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
