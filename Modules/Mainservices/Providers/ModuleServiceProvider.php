<?php

namespace TypiCMS\Modules\Mainservices\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Mainservices\Composers\SidebarViewComposer;
use TypiCMS\Modules\Mainservices\Facades\Mainservices;
use TypiCMS\Modules\Mainservices\Models\Mainservice;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'typicms.mainservices');
        $this->mergeConfigFrom(__DIR__.'/../config/permissions.php', 'typicms.permissions');

        // $modules = $this->app['config']['typicms']['modules'];
        // $this->app['config']->set('typicms.modules', array_merge(['mainservices' => ['linkable_to_page']], $modules));

        $this->loadViewsFrom(null, 'mainservices');

        $this->publishes([
            __DIR__.'/../database/migrations/create_mainservices_table.php.stub' => getMigrationFileName('create_mainservices_table'),
        ], 'migrations');

        AliasLoader::getInstance()->alias('Mainservices', Mainservices::class);


        /*
         * Sidebar view composer
         */
        $this->app->view->composer('core::admin._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        $this->app->view->composer('mainservices::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('mainservices');
        });
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register(RouteServiceProvider::class);

        $app->bind('Mainservices', Mainservice::class);
    }
}
