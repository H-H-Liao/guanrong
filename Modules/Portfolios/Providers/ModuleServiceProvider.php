<?php

namespace TypiCMS\Modules\Portfolios\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Portfolios\Composers\SidebarViewComposer;
use TypiCMS\Modules\Portfolios\Facades\Portfolios;
use TypiCMS\Modules\Portfolios\Models\Portfolio;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'typicms.portfolios');
        $this->mergeConfigFrom(__DIR__.'/../config/permissions.php', 'typicms.permissions');

        $modules = $this->app['config']['typicms']['modules'];
        $this->app['config']->set('typicms.modules', array_merge(['portfolios' => ['linkable_to_page']], $modules));

        $this->loadViewsFrom(null, 'portfolios');

        $this->publishes([
            __DIR__.'/../database/migrations/create_portfolios_table.php.stub' => getMigrationFileName('create_portfolios_table'),
        ], 'migrations');

        AliasLoader::getInstance()->alias('Portfolios', Portfolios::class);

        // Observers
        Portfolio::observe(new SlugObserver());

        /*
         * Sidebar view composer
         */
        $this->app->view->composer('core::admin._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        $this->app->view->composer('portfolios::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('portfolios');
        });
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register(RouteServiceProvider::class);

        $app->bind('Portfolios', Portfolio::class);
    }
}
