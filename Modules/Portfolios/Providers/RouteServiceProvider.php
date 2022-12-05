<?php

namespace TypiCMS\Modules\Portfolios\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Portfolios\Http\Controllers\AdminController;
use TypiCMS\Modules\Portfolios\Http\Controllers\ApiController;
use TypiCMS\Modules\Portfolios\Http\Controllers\PublicController;

class RouteServiceProvider extends ServiceProvider
{
    public function map()
    {
        /*
         * Front office routes
         */
        if ($page = TypiCMS::getPageLinkedToModule('portfolios')) {
            $middleware = $page->private ? ['public', 'auth'] : ['public'];
            foreach (locales() as $lang) {
                if ($page->isPublished($lang) && $uri = $page->uri($lang)) {
                    Route::middleware($middleware)->prefix($uri)->name($lang.'::')->group(function (Router $router) {
                        $router->get('/', [PublicController::class, 'index'])->name('index-portfolios');
                        $router->get('{slug}', [PublicController::class, 'show'])->name('portfolio');
                    });
                }
            }
        }

        /*
         * Admin routes
         */
        Route::middleware('admin')->prefix('admin')->name('admin::')->group(function (Router $router) {
            $router->get('portfolios', [AdminController::class, 'index'])->name('index-portfolios')->middleware('can:read portfolios');
            $router->get('portfolios/export', [AdminController::class, 'export'])->name('admin::export-portfolios')->middleware('can:read portfolios');
            $router->get('portfolios/create', [AdminController::class, 'create'])->name('create-portfolio')->middleware('can:create portfolios');
            $router->get('portfolios/{portfolio}/edit', [AdminController::class, 'edit'])->name('edit-portfolio')->middleware('can:read portfolios');
            $router->post('portfolios', [AdminController::class, 'store'])->name('store-portfolio')->middleware('can:create portfolios');
            $router->put('portfolios/{portfolio}', [AdminController::class, 'update'])->name('update-portfolio')->middleware('can:update portfolios');
        });

        /*
         * API routes
         */
        Route::middleware(['api', 'auth:api'])->prefix('api')->group(function (Router $router) {
            $router->get('portfolios', [ApiController::class, 'index'])->middleware('can:read portfolios');
            $router->patch('portfolios/{portfolio}', [ApiController::class, 'updatePartial'])->middleware('can:update portfolios');
            $router->delete('portfolios/{portfolio}', [ApiController::class, 'destroy'])->middleware('can:delete portfolios');
        });
    }
}
