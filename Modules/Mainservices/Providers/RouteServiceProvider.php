<?php

namespace TypiCMS\Modules\Mainservices\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Mainservices\Http\Controllers\AdminController;
use TypiCMS\Modules\Mainservices\Http\Controllers\ApiController;
use TypiCMS\Modules\Mainservices\Http\Controllers\PublicController;

class RouteServiceProvider extends ServiceProvider
{
    public function map()
    {

        /*
         * Admin routes
         */
        Route::middleware('admin')->prefix('admin')->name('admin::')->group(function (Router $router) {
            $router->get('mainservices', [AdminController::class, 'index'])->name('index-mainservices')->middleware('can:read mainservices');
            $router->get('mainservices/export', [AdminController::class, 'export'])->name('admin::export-mainservices')->middleware('can:read mainservices');
            $router->get('mainservices/create', [AdminController::class, 'create'])->name('create-mainservice')->middleware('can:create mainservices');
            $router->get('mainservices/{mainservice}/edit', [AdminController::class, 'edit'])->name('edit-mainservice')->middleware('can:read mainservices');
            $router->post('mainservices', [AdminController::class, 'store'])->name('store-mainservice')->middleware('can:create mainservices');
            $router->put('mainservices/{mainservice}', [AdminController::class, 'update'])->name('update-mainservice')->middleware('can:update mainservices');
        });

        /*
         * API routes
         */
        Route::middleware(['api', 'auth:api'])->prefix('api')->group(function (Router $router) {
            $router->get('mainservices', [ApiController::class, 'index'])->middleware('can:read mainservices');
            $router->patch('mainservices/{mainservice}', [ApiController::class, 'updatePartial'])->middleware('can:update mainservices');
            $router->delete('mainservices/{mainservice}', [ApiController::class, 'destroy'])->middleware('can:delete mainservices');
        });
    }
}
