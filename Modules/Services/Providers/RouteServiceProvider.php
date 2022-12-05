<?php

namespace TypiCMS\Modules\Services\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Services\Http\Controllers\AdminController;
use TypiCMS\Modules\Services\Http\Controllers\ApiController;
use TypiCMS\Modules\Services\Http\Controllers\PublicController;

class RouteServiceProvider extends ServiceProvider
{
    public function map()
    {
        /*
         * Front office routes
         */
        if ($page = TypiCMS::getPageLinkedToModule('services')) {
            $middleware = $page->private ? ['public', 'auth'] : ['public'];
            foreach (locales() as $lang) {
                if ($page->isPublished($lang) && $uri = $page->uri($lang)) {
                    Route::middleware($middleware)->prefix($uri)->name($lang.'::')->group(function (Router $router) {
                        $router->get('/', [PublicController::class, 'index'])->name('index-services');
                        $router->get('{slug}', [PublicController::class, 'show'])->name('service');
                    });
                }
            }
        }

        /*
         * Admin routes
         */
        Route::middleware('admin')->prefix('admin')->name('admin::')->group(function (Router $router) {
            $router->get('services', [AdminController::class, 'index'])->name('index-services')->middleware('can:read services');
            $router->get('services/export', [AdminController::class, 'export'])->name('admin::export-services')->middleware('can:read services');
            $router->get('services/create', [AdminController::class, 'create'])->name('create-service')->middleware('can:create services');
            $router->get('services/{service}/edit', [AdminController::class, 'edit'])->name('edit-service')->middleware('can:read services');
            $router->post('services', [AdminController::class, 'store'])->name('store-service')->middleware('can:create services');
            $router->put('services/{service}', [AdminController::class, 'update'])->name('update-service')->middleware('can:update services');
        });

        /*
         * API routes
         */
        Route::middleware(['api', 'auth:api'])->prefix('api')->group(function (Router $router) {
            $router->get('services', [ApiController::class, 'index'])->middleware('can:read services');
            $router->patch('services/{service}', [ApiController::class, 'updatePartial'])->middleware('can:update services');
            $router->delete('services/{service}', [ApiController::class, 'destroy'])->middleware('can:delete services');
        });
    }
}
