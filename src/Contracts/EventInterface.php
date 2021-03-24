<?php

namespace LabbeAramis\Modules\Contracts;

/**
 * Interface EventInterface
 *
 * @package LabbeAramis\Modules\Contracts
 */
interface EventInterface
{
    /**
     * @return bool
     */
    public function isRollback(): bool;

    /**
     * @param bool $isRollback
     *
     * @return EventInterface
     */
    public function setIsRollback( bool $isRollback ): self;
}
