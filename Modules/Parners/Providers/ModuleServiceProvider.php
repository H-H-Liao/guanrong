<?php

namespace TypiCMS\Modules\Parners\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Parners\Composers\SidebarViewComposer;
use TypiCMS\Modules\Parners\Facades\Parners;
use TypiCMS\Modules\Parners\Models\Parner;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'typicms.parners');
        $this->mergeConfigFrom(__DIR__.'/../config/permissions.php', 'typicms.permissions');

        $modules = $this->app['config']['typicms']['modules'];
        $this->app['config']->set('typicms.modules', array_merge(['parners' => ['linkable_to_page']], $modules));

        $this->loadViewsFrom(null, 'parners');

        $this->publishes([
            __DIR__.'/../database/migrations/create_parners_table.php.stub' => getMigrationFileName('create_parners_table'),
        ], 'migrations');

        AliasLoader::getInstance()->alias('Parners', Parners::class);


        /*
         * Sidebar view composer
         */
        $this->app->view->composer('core::admin._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        $this->app->view->composer('parners::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('parners');
        });
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register(RouteServiceProvider::class);

        $app->bind('Parners', Parner::class);
    }
}
