<?php

namespace LabbeAramis\Modules;

use Illuminate\Contracts\Queue\Factory as QueueFactoryContract;
use Illuminate\Events\EventServiceProvider as ServiceProvider;

/**
 * Class EventServiceProvider
 *
 * @package LabbeAramis\Modules
 */
class EventServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton( 'mediator', function ( $app ) {

            return ( new Mediator( $app ) )->setQueueResolver( function () use ( $app ) {

                return $app->make( QueueFactoryContract::class );
            } );
        } );
    }
}
