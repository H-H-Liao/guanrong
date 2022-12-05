<?php

namespace TypiCMS\Modules\Newsitems\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Newsitems\Http\Controllers\AdminController;
use TypiCMS\Modules\Newsitems\Http\Controllers\ApiController;
use TypiCMS\Modules\Newsitems\Http\Controllers\PublicController;

class RouteServiceProvider extends ServiceProvider
{
    public function map()
    {
        /*
         * Front office routes
         */
        if ($page = TypiCMS::getPageLinkedToModule('newsitems')) {
            $middleware = $page->private ? ['public', 'auth'] : ['public'];
            foreach (locales() as $lang) {
                if ($page->isPublished($lang) && $uri = $page->uri($lang)) {
                    Route::middleware($middleware)->prefix($uri)->name($lang.'::')->group(function (Router $router) {
                        $router->get('/', [PublicController::class, 'index'])->name('index-newsitems');
                        $router->get('{slug}', [PublicController::class, 'show'])->name('newsitem');
                    });
                }
            }
        }

        /*
         * Admin routes
         */
        Route::middleware('admin')->prefix('admin')->name('admin::')->group(function (Router $router) {
            $router->get('newsitems', [AdminController::class, 'index'])->name('index-newsitems')->middleware('can:read newsitems');
            $router->get('newsitems/export', [AdminController::class, 'export'])->name('admin::export-newsitems')->middleware('can:read newsitems');
            $router->get('newsitems/create', [AdminController::class, 'create'])->name('create-newsitem')->middleware('can:create newsitems');
            $router->get('newsitems/{newsitem}/edit', [AdminController::class, 'edit'])->name('edit-newsitem')->middleware('can:read newsitems');
            $router->post('newsitems', [AdminController::class, 'store'])->name('store-newsitem')->middleware('can:create newsitems');
            $router->put('newsitems/{newsitem}', [AdminController::class, 'update'])->name('update-newsitem')->middleware('can:update newsitems');
        });

        /*
         * API routes
         */
        Route::middleware(['api', 'auth:api'])->prefix('api')->group(function (Router $router) {
            $router->get('newsitems', [ApiController::class, 'index'])->middleware('can:read newsitems');
            $router->patch('newsitems/{newsitem}', [ApiController::class, 'updatePartial'])->middleware('can:update newsitems');
            $router->delete('newsitems/{newsitem}', [ApiController::class, 'destroy'])->middleware('can:delete newsitems');
        });
    }
}
