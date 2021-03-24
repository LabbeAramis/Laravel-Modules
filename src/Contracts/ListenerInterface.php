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
     * @return MediatorResponse
     */
    public function callback(): MediatorResponse;

    /**
     * @return MediatorResponse
     */
    public function fail(): MediatorResponse;
}
