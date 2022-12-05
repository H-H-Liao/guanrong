<?php

namespace TypiCMS\Modules\Parners\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Parners\Http\Controllers\AdminController;
use TypiCMS\Modules\Parners\Http\Controllers\ApiController;
use TypiCMS\Modules\Parners\Http\Controllers\PublicController;

class RouteServiceProvider extends ServiceProvider
{
    public function map()
    {
        /*
         * Front office routes
         */
        if ($page = TypiCMS::getPageLinkedToModule('parners')) {
            $middleware = $page->private ? ['public', 'auth'] : ['public'];
            foreach (locales() as $lang) {
                if ($page->isPublished($lang) && $uri = $page->uri($lang)) {
                    Route::middleware($middleware)->prefix($uri)->name($lang.'::')->group(function (Router $router) {
                        $router->get('/', [PublicController::class, 'index'])->name('index-parners');
                    });
                }
            }
        }

        /*
         * Admin routes
         */
        Route::middleware('admin')->prefix('admin')->name('admin::')->group(function (Router $router) {
            $router->get('parners', [AdminController::class, 'index'])->name('index-parners')->middleware('can:read parners');
            $router->get('parners/export', [AdminController::class, 'export'])->name('admin::export-parners')->middleware('can:read parners');
            $router->get('parners/create', [AdminController::class, 'create'])->name('create-parner')->middleware('can:create parners');
            $router->get('parners/{parner}/edit', [AdminController::class, 'edit'])->name('edit-parner')->middleware('can:read parners');
            $router->post('parners', [AdminController::class, 'store'])->name('store-parner')->middleware('can:create parners');
            $router->put('parners/{parner}', [AdminController::class, 'update'])->name('update-parner')->middleware('can:update parners');
        });

        /*
         * API routes
         */
        Route::middleware(['api', 'auth:api'])->prefix('api')->group(function (Router $router) {
            $router->get('parners', [ApiController::class, 'index'])->middleware('can:read parners');
            $router->patch('parners/{parner}', [ApiController::class, 'updatePartial'])->middleware('can:update parners');
            $router->delete('parners/{parner}', [ApiController::class, 'destroy'])->middleware('can:delete parners');
        });
    }
}
