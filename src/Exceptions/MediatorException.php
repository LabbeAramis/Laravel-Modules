<?php

namespace LabbeAramis\Modules\Exceptions;

/**
 * Class MediatorException
 *
 * @package LabbeAramis\Modules\Exceptions
 */
class MediatorException extends \Exception
{
    /**
     * @return static
     */
    public static function invalidResponse(): self
    {

        return new static( "Mediator listener response is not instance of MediatorResponse." );
    }
}
