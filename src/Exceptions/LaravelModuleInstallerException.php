<?php

namespace LabbeAramis\Modules\Exceptions;

use Exception;

/**
 * Class LaravelModuleInstallerException
 *
 * @package LabbeAramis\Modules\Exceptions
 */
class LaravelModuleInstallerException extends Exception
{
    public static function fromInvalidPackage( string $invalidPackageName ): self
    {

        return new self(
            "Ensure your package's name ({$invalidPackageName}) is in the format <vendor>/<name>-<module>"
        );
    }
}
