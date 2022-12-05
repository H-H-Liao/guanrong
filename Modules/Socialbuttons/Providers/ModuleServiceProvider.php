<?php

namespace TypiCMS\Modules\Socialbuttons\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Socialbuttons\Composers\SidebarViewComposer;
use TypiCMS\Modules\Socialbuttons\Facades\Socialbuttons;
use TypiCMS\Modules\Socialbuttons\Models\Socialbutton;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'typicms.socialbuttons');
        $this->mergeConfigFrom(__DIR__.'/../config/permissions.php', 'typicms.permissions');

        // $modules = $this->app['config']['typicms']['modules'];
        // $this->app['config']->set('typicms.modules', array_merge(['socialbuttons' => ['linkable_to_page']], $modules));

        $this->loadViewsFrom(null, 'socialbuttons');

        $this->publishes([
            __DIR__.'/../database/migrations/create_socialbuttons_table.php.stub' => getMigrationFileName('create_socialbuttons_table'),
        ], 'migrations');

        AliasLoader::getInstance()->alias('Socialbuttons', Socialbuttons::class);


        /*
         * Sidebar view composer
         */
        $this->app->view->composer('core::admin._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        $this->app->view->composer('socialbuttons::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('socialbuttons');
        });
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register(RouteServiceProvider::class);

        $app->bind('Socialbuttons', Socialbutton::class);
    }
}
