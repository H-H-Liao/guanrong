<?php

namespace TypiCMS\Modules\Pagebanners\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Pagebanners\Composers\SidebarViewComposer;
use TypiCMS\Modules\Pagebanners\Facades\Pagebanners;
use TypiCMS\Modules\Pagebanners\Models\Pagebanner;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'typicms.pagebanners');
        $this->mergeConfigFrom(__DIR__.'/../config/permissions.php', 'typicms.permissions');

        $this->loadViewsFrom(null, 'pagebanners');

        $this->publishes([
            __DIR__.'/../database/migrations/create_pagebanners_table.php.stub' => getMigrationFileName('create_pagebanners_table'),
        ], 'migrations');

        AliasLoader::getInstance()->alias('Pagebanners', Pagebanners::class);


        /*
         * Sidebar view composer
         */
        $this->app->view->composer('core::admin._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        $this->app->view->composer('pagebanners::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('pagebanners');
        });
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register(RouteServiceProvider::class);

        $app->bind('Pagebanners', Pagebanner::class);
    }
}
