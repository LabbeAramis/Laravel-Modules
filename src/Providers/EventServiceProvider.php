<?php

namespace LabbeAramis\Modules\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use LabbeAramis\Modules\Facades\Event;
use LabbeAramis\Modules\Contracts\RepositoryInterface;

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
                    Event::listen( $event, $listener );
                }
            }

            foreach ($this->subscribe as $subscriber) {
                Event::subscribe( $subscriber );
            }
        } );
    }

    /**
     * Boot any application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->registerListeners();
    }

    /**
     * @return array
     */
    public function registerListeners(): array
    {

        $laravelFileRepository = app( RepositoryInterface::class );

        $listeners = [];

        foreach ($laravelFileRepository->scan() as $module) {
            $moduleListeners = $module->get( 'listeners' );
            if ( $moduleListeners !== null
                && is_array( $moduleListeners ) === true
                && count( $moduleListeners ) > 0 ) {
                foreach ($moduleListeners as $event => $listener) {
                    if ( is_array( $listener ) === true && count( $listener ) > 0 ) {
                        foreach ($listener as $className) {
                            if ( class_exists( $className, true ) === true ) {
                                $listeners[$event][] = $className;

                                Event::listen(
                                    $event,
                                    [$className, 'handle']
                                );
                            }
                        }
                    }
                }
            }
        }

        return $listeners;
    }
}
