<?php

namespace LabbeAramis\Modules\Traits;

use LabbeAramis\Modules\Events\RouteEvent;
use LabbeAramis\Modules\MediatorResponse;

/**
 * Trait Controllable
 *
 * @package LabbeAramis\Modules\Traits
 */
trait Controllable
{
    /**
     * Dispatch the event with the given arguments to controller.
     *
     * @return MediatorResponse[]|MediatorResponse|null
     */
    public static function dispatch()
    {

        return RouteEvent::dispatch(...func_get_args());
    }
}
