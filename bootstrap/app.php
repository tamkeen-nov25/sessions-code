<?php

use App\Http\Middleware\AgeMiddleware;
use App\Http\Middleware\ApiLocalization;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\Test2Middleware;
use App\Http\Middleware\TestMiddleware;
use App\Http\Middleware\WebLocalization;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        channels: __DIR__ . '/../routes/channels.php',
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,

        ]);
        // $middleware->alias([
        //     'role' => RoleMiddleware::class
        // ]);
        $middleware->api([
            ApiLocalization::class
        ]);

        $middleware->web([
            WebLocalization::class
        ]);
        // $middleware->append([
        //     AgeMiddleware::class
        // ]);

        // $middleware->alias([
        //     'test' => TestMiddleware::class
        // ]);
        // $middleware->append([]);

        // $middleware->group('alissar', [
        //     TestMiddleware::class,
        // ]);

        // $middleware->web([
        //     Test2Middleware::class

        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // betweentwopoints("hello");

        // $exceptions->report(function (Throwable $exception) {

        //     if ($exception instanceof Exception) {
        //         Log::info($exception->getMessage());
        //     }
        // })->stop();
        $exceptions->render(function (Throwable $th, Request $request) {

            // dd($th);

            if ($th instanceof NotFoundHttpException) {
                return response()->json([
                    'message' => "not found"
                ], 404);
            }

            if ($th instanceof HttpException) {
                return response()->json([
                    'message' => $th->getMessage()
                ], 400);
            }




            // if ($th instanceof HttpExceptionInterface) {
            //     return successResponse($th->getMessage(), $th->getStatusCode());
            // }


            // return response()->json([
            //     'message' => "something went wrong"
            // ], 500);
        });
    })->create();
