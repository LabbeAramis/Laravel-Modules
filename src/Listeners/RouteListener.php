<?php

namespace LabbeAramis\Modules\Listeners;

use LabbeAramis\Modules\Contracts\EventInterface;
use LabbeAramis\Modules\Events\RouteEvent;
use LabbeAramis\Modules\Listener;
use LabbeAramis\Modules\MediatorResponse;

/**
 * Class RouteListener
 *
 * @package LabbeAramis\Modules\Listeners
 */
class RouteListener extends Listener
{

    /**
     * @param EventInterface $event
     *
     * @return MediatorResponse
     */
    public function callback(EventInterface $event): MediatorResponse
    {
        /** @var RouteEvent $event */
        $controller = $event->getController();
        $method = $event->getMethod();
        $request = $event->getRequest();

        if ( method_exists($controller, $method) === true ) {

            try {
                $data = $request === null ? $controller->{$method}() : $controller->{$method}($request);

                return new MediatorResponse($event->getName(), $data, true);
            } catch (\Throwable $e) {
                return new MediatorResponse($event->getName(), null, false);
            }
        }
    }

    /**
     * @param EventInterface $event
     *
     * @return MediatorResponse
     */
    public function fail(EventInterface $event): MediatorResponse
    {
        //
    }
}
