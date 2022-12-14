<?php

namespace TypiCMS\Modules\Search\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Search\Http\Controllers\PublicController;

class RouteServiceProvider extends ServiceProvider
{
    public function map(Router $router)
    {
        /*
         * Front office routes
         */
        if ($page = TypiCMS::getPageLinkedToModule('search')) {
            $middleware = $page->private ? ['public', 'auth'] : ['public'];
            foreach (locales() as $lang) {
                if ($page->isPublished($lang) && $uri = $page->uri($lang)) {
                    Route::middleware($middleware)->prefix($uri)->name($lang.'::')->group(function (Router $router) {
                        $router->get('/', [PublicController::class, 'search'])->name('search');
                        $router->get('/quick_search', [PublicController::class, 'quickSearch'])->name('quick_search');
                    });
                }
            }
        }
    }
}
