<?php

namespace iNaru\Support;

use Illuminate\Contracts\Foundation\CachesConfiguration;
use Illuminate\Contracts\Foundation\CachesRoutes;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

abstract class ServiceProvider extends BaseServiceProvider
{
    /**
     * Override the given configuration to the existing configuration.
     *
     * @param  string  $path
     * @param  string  $key
     * @return void
     */
    protected function overrideConfigFrom($path, $key)
    {
        if (!($this->app instanceof CachesConfiguration && $this->app->configurationIsCached())) {
            $this->app['config']->set($key, array_merge(
                $this->app['config']->get($key, []),
                require $path
            ));
        }
    }

    /**
     * Register the given routes file if routes are not already cached.
     *
     * @param array     $options
     * @param string    $path
     * @return void
     */
    protected function registerRoutesFrom(string $path, array $options = [])
    {
        if (!($this->app instanceof CachesRoutes && $this->app->routesAreCached())) {
            Route::group($options, $path);
        }
    }
}