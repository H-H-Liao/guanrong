<?php

namespace TypiCMS\Modules\Socialbuttons\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Socialbuttons\Http\Controllers\AdminController;
use TypiCMS\Modules\Socialbuttons\Http\Controllers\ApiController;
use TypiCMS\Modules\Socialbuttons\Http\Controllers\PublicController;

class RouteServiceProvider extends ServiceProvider
{
    public function map()
    {

        /*
         * Admin routes
         */
        Route::middleware('admin')->prefix('admin')->name('admin::')->group(function (Router $router) {
            $router->get('socialbuttons', [AdminController::class, 'index'])->name('index-socialbuttons')->middleware('can:read socialbuttons');
            $router->get('socialbuttons/export', [AdminController::class, 'export'])->name('admin::export-socialbuttons')->middleware('can:read socialbuttons');
            $router->get('socialbuttons/create', [AdminController::class, 'create'])->name('create-socialbutton')->middleware('can:create socialbuttons');
            $router->get('socialbuttons/{socialbutton}/edit', [AdminController::class, 'edit'])->name('edit-socialbutton')->middleware('can:read socialbuttons');
            $router->post('socialbuttons', [AdminController::class, 'store'])->name('store-socialbutton')->middleware('can:create socialbuttons');
            $router->put('socialbuttons/{socialbutton}', [AdminController::class, 'update'])->name('update-socialbutton')->middleware('can:update socialbuttons');
        });

        /*
         * API routes
         */
        Route::middleware(['api', 'auth:api'])->prefix('api')->group(function (Router $router) {
            $router->get('socialbuttons', [ApiController::class, 'index'])->middleware('can:read socialbuttons');
            $router->patch('socialbuttons/{socialbutton}', [ApiController::class, 'updatePartial'])->middleware('can:update socialbuttons');
            $router->delete('socialbuttons/{socialbutton}', [ApiController::class, 'destroy'])->middleware('can:delete socialbuttons');
        });
    }
}
