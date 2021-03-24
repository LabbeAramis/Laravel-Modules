<?php

namespace LabbeAramis\Modules;

/**
 * Class MediatorResponse
 */
final class MediatorResponse
{
    /**
     * @var string|null
     */
    private ?string $name;

    /**
     * @var null
     */
    private $data;

    /**
     * @var bool
     */
    private bool $isSuccess;

    /**
     * MediatorResponse constructor.
     *
     * @param null $name
     * @param null $data
     * @param bool $isSuccess
     */
    public function __construct( $name = null, $data = null, bool $isSuccess = false )
    {

        $this->name      = $name;
        $this->data      = $data;
        $this->isSuccess = $isSuccess;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {

        return $this->name;
    }

    /**
     * @return null
     */
    public function getData()
    {

        return $this->data;
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {

        return $this->isSuccess;
    }
}
