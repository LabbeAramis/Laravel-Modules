<?php

namespace LabbeAramis\Modules;

/**
 * Class MediatorResponse
 */
class MediatorResponse
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
     * MediatorResponse constructor.
     *
     * @param null $name
     * @param null $data
     */
    public function __construct( $name = null, $data = null )
    {

        $this->name = $name;
        $this->data = $data;
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
}
