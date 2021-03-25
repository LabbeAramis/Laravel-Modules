<?php

namespace LabbeAramis\Modules;

use Closure;
use LabbeAramis\Modules\Contracts\EventInterface;
use LabbeAramis\Modules\Contracts\ListenerInterface;
use LabbeAramis\Modules\Exceptions\ListenerException;

/**
 * Class Listener
 *
 * @package LabbeAramis\Modules
 */
abstract class Listener implements ListenerInterface
{

    /**
     * @param EventInterface $event
     *
     * @return MediatorResponse
     * @throws ListenerException
     */
    public function handle( EventInterface $event ): MediatorResponse
    {

        try {

            if ( $event->isRollback() === true ) {

                throw ListenerException::callbackError();
            }

            $event->beforeHandleCallback();

            if ( method_exists( $this, 'callback' ) === true ) {

                $response = $this->callback( $event );

                $event->afterHandleCallback();

                return $response;
            }

            throw ListenerException::callbackError();

        } catch (\Throwable $e) {

            try {

                $event->beforeFailCallback();

                if ( method_exists( $this, 'fail' ) === true ) {

                    $response = $this->fail( $event );

                    $event->afterFailCallback();

                    return $response;
                }

                throw ListenerException::failError();

            } catch (\Throwable $e) {

                throw ListenerException::handleError( $e );
            }
        }
    }

    /**
     * @param EventInterface $event
     *
     * @return MediatorResponse
     */
    abstract public function callback( EventInterface $event ): MediatorResponse;

    /**
     * @param EventInterface $event
     *
     * @return MediatorResponse
     */
    abstract public function fail( EventInterface $event ): MediatorResponse;

}
