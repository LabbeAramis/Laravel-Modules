<?php

namespace LabbeAramis\Modules;

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
            if ( method_exists( $this, 'callback' ) === true ) {
                return $this->callback( $event );
            }
            throw ListenerException::callbackError();
        } catch (\Throwable $e) {
            try {
                if ( method_exists( $this, 'fail' ) === true ) {
                    return $this->fail( $event );
                }
                throw ListenerException::failError();
            } catch (\Throwable $e) {
                throw ListenerException::handleError();
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
