<?php

namespace TypiCMS\Modules\Services\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Services\Composers\SidebarViewComposer;
use TypiCMS\Modules\Services\Facades\Services;
use TypiCMS\Modules\Services\Models\Service;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'typicms.services');
        $this->mergeConfigFrom(__DIR__.'/../config/permissions.php', 'typicms.permissions');

        $modules = $this->app['config']['typicms']['modules'];
        $this->app['config']->set('typicms.modules', array_merge(['services' => ['linkable_to_page']], $modules));

        $this->loadViewsFrom(null, 'services');

        $this->publishes([
            __DIR__.'/../database/migrations/create_services_table.php.stub' => getMigrationFileName('create_services_table'),
        ], 'migrations');

        AliasLoader::getInstance()->alias('Services', Services::class);

        // Observers
        Service::observe(new SlugObserver());

        /*
         * Sidebar view composer
         */
        $this->app->view->composer('core::admin._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        $this->app->view->composer('services::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('services');
        });
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register(RouteServiceProvider::class);

        $app->bind('Services', Service::class);
    }
}
