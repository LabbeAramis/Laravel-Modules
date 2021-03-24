<?php

namespace LabbeAramis\Modules;

use Illuminate\Support\ServiceProvider;
use LabbeAramis\Modules\Providers\BootstrapServiceProvider;
use LabbeAramis\Modules\Providers\ConsoleServiceProvider;
use LabbeAramis\Modules\Providers\ContractsServiceProvider;
use LabbeAramis\Modules\Providers\EventServiceProvider;

/**
 * Class ModulesServiceProvider
 *
 * @package LabbeAramis\Modules
 */
abstract class ModulesServiceProvider extends ServiceProvider
{
    /**
     * Booting the package.
     */
    public function boot()
    {
    }

    /**
     * Register all modules.
     */
    public function register()
    {
    }

    /**
     * Register all modules.
     */
    protected function registerModules()
    {

        $this->app->register( BootstrapServiceProvider::class );
    }

    /**
     * Register package's namespaces.
     */
    protected function registerNamespaces()
    {

        $configPath = __DIR__ . '/../config/config.php';

        $this->mergeConfigFrom( $configPath, 'modules' );
        $this->publishes( [
            $configPath => config_path( 'modules.php' ),
        ], 'config' );
    }

    /**
     * Register the service provider.
     */
    abstract protected function registerServices();

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {

        return [Contracts\RepositoryInterface::class, 'modules'];
    }

    /**
     * Register providers.
     */
    protected function registerProviders()
    {

        $this->app->register( ConsoleServiceProvider::class );
        $this->app->register( ContractsServiceProvider::class );
        $this->app->register( EventServiceProvider::class );
    }
}
