<?php

namespace TypiCMS\Modules\Homeprojects\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Homeprojects\Composers\SidebarViewComposer;
use TypiCMS\Modules\Homeprojects\Facades\Homeprojects;
use TypiCMS\Modules\Homeprojects\Models\Homeproject;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'typicms.homeprojects');
        $this->mergeConfigFrom(__DIR__.'/../config/permissions.php', 'typicms.permissions');

        // $modules = $this->app['config']['typicms']['modules'];
        // $this->app['config']->set('typicms.modules', array_merge(['homeprojects' => ['linkable_to_page']], $modules));

        $this->loadViewsFrom(null, 'homeprojects');

        $this->publishes([
            __DIR__.'/../database/migrations/create_homeprojects_table.php.stub' => getMigrationFileName('create_homeprojects_table'),
        ], 'migrations');

        AliasLoader::getInstance()->alias('Homeprojects', Homeprojects::class);



        /*
         * Sidebar view composer
         */
        $this->app->view->composer('core::admin._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        $this->app->view->composer('homeprojects::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('homeprojects');
        });
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register(RouteServiceProvider::class);

        $app->bind('Homeprojects', Homeproject::class);
    }
}
