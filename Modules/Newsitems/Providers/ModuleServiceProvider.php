<?php

namespace TypiCMS\Modules\Newsitems\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Newsitems\Composers\SidebarViewComposer;
use TypiCMS\Modules\Newsitems\Facades\Newsitems;
use TypiCMS\Modules\Newsitems\Models\Newsitem;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'typicms.newsitems');
        $this->mergeConfigFrom(__DIR__.'/../config/permissions.php', 'typicms.permissions');

        $modules = $this->app['config']['typicms']['modules'];
        $this->app['config']->set('typicms.modules', array_merge(['newsitems' => ['linkable_to_page']], $modules));

        $this->loadViewsFrom(null, 'newsitems');

        $this->publishes([
            __DIR__.'/../database/migrations/create_newsitems_table.php.stub' => getMigrationFileName('create_newsitems_table'),
        ], 'migrations');

        AliasLoader::getInstance()->alias('Newsitems', Newsitems::class);

        // Observers
        Newsitem::observe(new SlugObserver());

        /*
         * Sidebar view composer
         */
        $this->app->view->composer('core::admin._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        $this->app->view->composer('newsitems::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('newsitems');
        });
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register(RouteServiceProvider::class);

        $app->bind('Newsitems', Newsitem::class);
    }
}
