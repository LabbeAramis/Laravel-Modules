<?php

namespace LabbeAramis\Modules;

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
     * @return MediatorResponse
     * @throws ListenerException
     */
    public function handle(): MediatorResponse
    {

        try {
            if ( method_exists( $this, 'callback' ) === true ) {
                return $this->callback( ...func_get_args() );
            }
            throw ListenerException::callbackError();
        } catch (\Throwable $e) {
            try {
                if ( method_exists( $this, 'fail' ) === true ) {
                    return $this->fail( ...func_get_args() );
                }
                throw ListenerException::failError();
            } catch (\Throwable $e) {
                throw ListenerException::handleError();
            }
        }
    }

    /**
     * @param array $args
     *
     * @return MediatorResponse
     */
    abstract public function callback( ...$args ): MediatorResponse;

    /**
     * @param array $args
     *
     * @return MediatorResponse
     */
    abstract public function fail( ...$args ): MediatorResponse;

}
