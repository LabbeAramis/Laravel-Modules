<?php

namespace LabbeAramis\Modules\Traits;

use LabbeAramis\Modules\MediatorResponse;

/**
 * Trait Dispatchable
 *
 * @package LabbeAramis\Modules\Traits
 */
trait Dispatchable
{
    /**
     * Dispatch the event with the given arguments.
     *
     * @return MediatorResponse[]|MediatorResponse|null
     */
    public static function dispatch()
    {

        return mediator_event( new static( ...func_get_args() ) );
    }
}
