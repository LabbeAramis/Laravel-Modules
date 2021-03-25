<?php

namespace LabbeAramis\Modules;

use Closure;
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
     * @var Closure|null
     */
    private ?Closure $beforeHandleCallback = null;

    /**
     * @var Closure|null
     */
    private ?Closure $afterHandleCallback = null;

    /**
     * @var Closure|null
     */
    private ?Closure $beforeFailCallback = null;

    /**
     * @var Closure|null
     */
    private ?Closure $afterFailCallback = null;

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

    /**
     * @return Closure|null
     */
    public function getBeforeHandleCallback(): ?Closure
    {

        return $this->beforeHandleCallback;
    }

    /**
     * @param Closure|null $beforeHandleCallback
     *
     * @return $this
     */
    public function setBeforeHandleCallback( ?Closure $beforeHandleCallback ): self
    {

        $this->beforeHandleCallback = $beforeHandleCallback;

        return $this;
    }

    /**
     * @return Closure|null
     */
    public function getAfterHandleCallback(): ?Closure
    {

        return $this->afterHandleCallback;
    }

    /**
     * @param Closure|null $afterHandleCallback
     *
     * @return $this
     */
    public function setAfterHandleCallback( ?Closure $afterHandleCallback ): self
    {

        $this->afterHandleCallback = $afterHandleCallback;

        return $this;
    }

    /**
     * @return Closure|null
     */
    public function getBeforeFailCallback(): ?Closure
    {

        return $this->beforeFailCallback;
    }

    /**
     * @param Closure|null $beforeFailCallback
     *
     * @return $this
     */
    public function setBeforeFailCallback( ?Closure $beforeFailCallback ): self
    {

        $this->beforeFailCallback = $beforeFailCallback;

        return $this;
    }

    /**
     * @return Closure|null
     */
    public function getAfterFailCallback(): ?Closure
    {

        return $this->afterFailCallback;
    }

    /**
     * @param Closure|null $afterFailCallback
     *
     * @return $this
     */
    public function setAfterFailCallback( ?Closure $afterFailCallback ): self
    {

        $this->afterFailCallback = $afterFailCallback;

        return $this;
    }

}
