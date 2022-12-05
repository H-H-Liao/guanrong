<?php

namespace TypiCMS\Modules\Fqs\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Fqs\Composers\SidebarViewComposer;
use TypiCMS\Modules\Fqs\Facades\Fqs;
use TypiCMS\Modules\Fqs\Models\Fq;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'typicms.fqs');
        $this->mergeConfigFrom(__DIR__.'/../config/permissions.php', 'typicms.permissions');

        $modules = $this->app['config']['typicms']['modules'];
        $this->app['config']->set('typicms.modules', array_merge(['fqs' => ['linkable_to_page']], $modules));

        $this->loadViewsFrom(null, 'fqs');

        $this->publishes([
            __DIR__.'/../database/migrations/create_fqs_table.php.stub' => getMigrationFileName('create_fqs_table'),
        ], 'migrations');

        AliasLoader::getInstance()->alias('Fqs', Fqs::class);

        /*
         * Sidebar view composer
         */
        $this->app->view->composer('core::admin._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        $this->app->view->composer('fqs::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('fqs');
        });
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register(RouteServiceProvider::class);

        $app->bind('Fqs', Fq::class);
    }
}
