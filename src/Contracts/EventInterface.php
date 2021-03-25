<?php

namespace LabbeAramis\Modules\Contracts;

use Closure;

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

    /**
     * @return Closure|null
     */
    public function getBeforeHandleCallback(): ?Closure;

    /**
     * @param Closure|null $beforeHandleCallback
     *
     * @return $this
     */
    public function setBeforeHandleCallback( ?Closure $beforeHandleCallback ): self;

    /**
     * @return Closure|null
     */
    public function getAfterHandleCallback(): ?Closure;

    /**
     * @param Closure|null $afterHandleCallback
     *
     * @return $this
     */
    public function setAfterHandleCallback( ?Closure $afterHandleCallback ): self;

    /**
     * @return Closure|null
     */
    public function getBeforeFailCallback(): ?Closure;

    /**
     * @param Closure|null $beforeFailCallback
     *
     * @return $this
     */
    public function setBeforeFailCallback( ?Closure $beforeFailCallback ): self;

    /**
     * @return Closure|null
     */
    public function getAfterFailCallback(): ?Closure;

    /**
     * @param Closure|null $afterFailCallback
     *
     * @return $this
     */
    public function setAfterFailCallback( ?Closure $afterFailCallback ): self;
}
