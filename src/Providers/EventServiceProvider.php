<?php

namespace LabbeAramis\Modules\Providers;

use Illuminate\Contracts\Queue\Factory as QueueFactoryContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use LabbeAramis\Modules\Facades\Mediator as MediatorFacade;
use LabbeAramis\Modules\Mediator;

/**
 * Class EventServiceProvider
 *
 * @package LabbeAramis\Modules\Providers
 */
class EventServiceProvider extends ServiceProvider
{
    /**
     * Register the application's event listeners.
     *
     * @return void
     */
    public function register()
    {

        $this->booting( function () {

            $events = $this->getEvents();

            foreach ($events as $event => $listeners) {
                foreach (array_unique( $listeners ) as $listener) {
                    MediatorFacade::listen( $event, $listener );
                }
            }

            foreach ($this->subscribe as $subscriber) {
                MediatorFacade::subscribe( $subscriber );
            }
        } );
    }
}
