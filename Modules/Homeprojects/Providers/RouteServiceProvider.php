<?php

namespace TypiCMS\Modules\Homeprojects\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Homeprojects\Http\Controllers\AdminController;
use TypiCMS\Modules\Homeprojects\Http\Controllers\ApiController;
use TypiCMS\Modules\Homeprojects\Http\Controllers\PublicController;

class RouteServiceProvider extends ServiceProvider
{
    public function map()
    {

        /*
         * Admin routes
         */
        Route::middleware('admin')->prefix('admin')->name('admin::')->group(function (Router $router) {
            $router->get('homeprojects', [AdminController::class, 'index'])->name('index-homeprojects')->middleware('can:read homeprojects');
            $router->get('homeprojects/export', [AdminController::class, 'export'])->name('admin::export-homeprojects')->middleware('can:read homeprojects');
            $router->get('homeprojects/create', [AdminController::class, 'create'])->name('create-homeproject')->middleware('can:create homeprojects');
            $router->get('homeprojects/{homeproject}/edit', [AdminController::class, 'edit'])->name('edit-homeproject')->middleware('can:read homeprojects');
            $router->post('homeprojects', [AdminController::class, 'store'])->name('store-homeproject')->middleware('can:create homeprojects');
            $router->put('homeprojects/{homeproject}', [AdminController::class, 'update'])->name('update-homeproject')->middleware('can:update homeprojects');
        });

        /*
         * API routes
         */
        Route::middleware(['api', 'auth:api'])->prefix('api')->group(function (Router $router) {
            $router->get('homeprojects', [ApiController::class, 'index'])->middleware('can:read homeprojects');
            $router->patch('homeprojects/{homeproject}', [ApiController::class, 'updatePartial'])->middleware('can:update homeprojects');
            $router->delete('homeprojects/{homeproject}', [ApiController::class, 'destroy'])->middleware('can:delete homeprojects');
        });
    }
}
