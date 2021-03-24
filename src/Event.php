<?php

namespace LabbeAramis\Modules;

use LabbeAramis\Modules\Contracts\EventInterface;

/**
 * Class Event
 *
 * @package LabbeAramis\Modules
 */
class Event implements EventInterface
{
    /**
     * @var bool
     */
    private bool $isRollback = false;

    /**
     * @return bool
     */
    public function isRollback(): bool
    {

        return $this->isRollback;
    }

    /**
     * @param bool $isRollback
     *
     * @return $this
     */
    public function setIsRollback( bool $isRollback ): self
    {

        $this->isRollback = $isRollback;

        return $this;
    }
}
