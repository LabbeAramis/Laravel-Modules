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
    public function __construct( $name = null, $data = null, bool $isSuccess = true )
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

    /**
     * @param MediatorResponse[] $responses
     *
     * @return bool
     */
    public static function isSuccessAll( array $responses = [] ): bool
    {

        foreach ($responses as $response) {
            if ( $response->isSuccess() === false ) {
                return false;
            }
        }

        return true;
    }
}
