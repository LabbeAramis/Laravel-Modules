<?php

namespace LabbeAramis\Modules\Commands;

use LabbeAramis\Modules\Support\Config\GenerateConfigReader;
use LabbeAramis\Modules\Support\Stub;
use LabbeAramis\Modules\Traits\ModuleCommandTrait;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class EventProviderMakeCommand
 *
 * @package LabbeAramis\Modules\Commands
 */
class EventProviderMakeCommand extends GeneratorCommand
{
    use ModuleCommandTrait;

    protected $argumentName = 'module';

    /**
     * The command name.
     *
     * @var string
     */
    protected $name = 'module:event-provider';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Create a new event service provider for the specified module.';

    /**
     * The command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {

        return [
            ['module', InputArgument::OPTIONAL, 'The name of module will be used.'],
        ];
    }

    protected function getOptions()
    {

        return [
            ['force', null, InputOption::VALUE_NONE, 'Force the operation to run when the file already exists.'],
        ];
    }

    /**
     * Get template contents.
     *
     * @return string
     */
    protected function getTemplateContents()
    {

        $module = $this->laravel['modules']->findOrFail( $this->getModuleName() );

        return ( new Stub( '/event-provider.stub', [
            'NAMESPACE'        => $this->getClassNamespace( $module ),
            'CLASS'            => $this->getFileName(),
            'MODULE_NAMESPACE' => $this->laravel['modules']->config( 'namespace' ),
            'MODULE'           => $this->getModuleName(),
            'LOWER_NAME'       => $module->getLowerName(),
        ] ) )->render();
    }

    /**
     * @return string
     */
    private function getFileName()
    {

        return 'EventServiceProvider';
    }

    /**
     * Get the destination file path.
     *
     * @return string
     */
    protected function getDestinationFilePath()
    {

        $path = $this->laravel['modules']->getModulePath( $this->getModuleName() );

        $generatorPath = GenerateConfigReader::read( 'provider' );

        return $path . $generatorPath->getPath() . '/' . $this->getFileName() . '.php';
    }

    public function getDefaultNamespace(): string
    {

        $module = $this->laravel['modules'];

        return $module->config( 'paths.generator.provider.namespace' ) ?: $module->config( 'paths.generator.provider.path', 'Providers' );
    }
}
