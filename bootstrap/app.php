<?php

use App\Http\Middleware\ApiLocalization;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\Test2Middleware;
use App\Http\Middleware\TestMiddleware;
use App\Http\Middleware\WebLocalization;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
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
        //     TestMiddleware::class
        // ]);

        // $middleware->alias([
        //     'test' => TestMiddleware::class
        // ]);

        $middleware->group('alissar', [
            TestMiddleware::class,
        ]);

        $middleware->web(append: [
            Test2Middleware::class

        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // $exceptions->report(function (Throwable $exception) {

        //     if ($exception instanceof Exception) {
        //         Log::info($exception->getMessage());
        //     }
        // })->stop();
        // $exceptions->render(function (Throwable $th,Request $request) {


        //     if ($th instanceof BadRequestHttpException) {
        //         return response()->json([
        //             'message' => "bad request"
        //         ], 400);
        //     }


        //     if ($th instanceof HttpExceptionInterface) {
        //         return successResponse($th->getMessage(), $th->getStatusCode());
        //     }


        //     // return response()->json([
        //     //     'message' => "something went wrong"
        //     // ], 500);
        // });
    })->create();
