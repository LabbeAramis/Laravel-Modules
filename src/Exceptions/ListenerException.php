<?php

namespace LabbeAramis\Modules\Exceptions;

/**
 * Class ListenerException
 *
 * @package LabbeAramis\Modules\Exceptions
 */
class ListenerException extends \Exception
{
    /**
     * @param $e
     *
     * @return static
     */
    public static function callbackError( $e = null ): self
    {

        return new static( "Listener callback error.", null, $e );
    }

    /**
     * @param $e
     *
     * @return static
     */
    public static function failError( $e = null ): self
    {

        return new static( "Listener fail error.", null, $e );
    }

    /**
     * @param $e
     *
     * @return static
     */
    public static function handleError( $e = null ): self
    {

        return new static( "Listener handle error.", null, $e );
    }
}
