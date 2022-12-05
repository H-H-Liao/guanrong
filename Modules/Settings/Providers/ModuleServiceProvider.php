<?php

namespace TypiCMS\Modules\Settings\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Settings\Models\Setting;


class ModuleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        /*
         * Get configuration from DB and store it in the container
         */
        $TypiCMSConfig = $this->app->make('Settings')->allToArray();

        // merge config
        $config = $this->app['config']->get('typicms', []);
        $this->app['config']->set('typicms', array_merge($TypiCMSConfig, $config));

        $this->loadViewsFrom(__DIR__.'/../resources/views/', 'settings');




        AliasLoader::getInstance()->alias('Settings', Setting::class);
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register(RouteServiceProvider::class);

        $app->bind('Settings', Setting::class);
    }
}
