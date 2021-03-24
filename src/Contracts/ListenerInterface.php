<?php

namespace LabbeAramis\Modules\Contracts;

use LabbeAramis\Modules\MediatorResponse;

/**
 * Interface ListenerInterface
 *
 * @package LabbeAramis\Modules\Contracts
 */
interface ListenerInterface
{
    /**
     * @param EventInterface $event
     *
     * @return MediatorResponse
     */
    public function callback( EventInterface $event ): MediatorResponse;

    /**
     * @param EventInterface $event
     *
     * @return MediatorResponse
     */
    public function fail( EventInterface $event ): MediatorResponse;
}
