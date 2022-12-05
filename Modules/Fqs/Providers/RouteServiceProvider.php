<?php

namespace TypiCMS\Modules\Fqs\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Fqs\Http\Controllers\AdminController;
use TypiCMS\Modules\Fqs\Http\Controllers\ApiController;
use TypiCMS\Modules\Fqs\Http\Controllers\PublicController;

class RouteServiceProvider extends ServiceProvider
{
    public function map()
    {
        /*
         * Front office routes
         */
        if ($page = TypiCMS::getPageLinkedToModule('fqs')) {
            $middleware = $page->private ? ['public', 'auth'] : ['public'];
            foreach (locales() as $lang) {
                if ($page->isPublished($lang) && $uri = $page->uri($lang)) {
                    Route::middleware($middleware)->prefix($uri)->name($lang.'::')->group(function (Router $router) {
                        $router->get('/', [PublicController::class, 'index'])->name('index-fqs');
                    });
                }
            }
        }

        /*
         * Admin routes
         */
        Route::middleware('admin')->prefix('admin')->name('admin::')->group(function (Router $router) {
            $router->get('fqs', [AdminController::class, 'index'])->name('index-fqs')->middleware('can:read fqs');
            $router->get('fqs/export', [AdminController::class, 'export'])->name('admin::export-fqs')->middleware('can:read fqs');
            $router->get('fqs/create', [AdminController::class, 'create'])->name('create-fq')->middleware('can:create fqs');
            $router->get('fqs/{fq}/edit', [AdminController::class, 'edit'])->name('edit-fq')->middleware('can:read fqs');
            $router->post('fqs', [AdminController::class, 'store'])->name('store-fq')->middleware('can:create fqs');
            $router->put('fqs/{fq}', [AdminController::class, 'update'])->name('update-fq')->middleware('can:update fqs');
        });

        /*
         * API routes
         */
        Route::middleware(['api', 'auth:api'])->prefix('api')->group(function (Router $router) {
            $router->get('fqs', [ApiController::class, 'index'])->middleware('can:read fqs');
            $router->patch('fqs/{fq}', [ApiController::class, 'updatePartial'])->middleware('can:update fqs');
            $router->delete('fqs/{fq}', [ApiController::class, 'destroy'])->middleware('can:delete fqs');
        });
    }
}
