<?php

namespace LabbeAramis\Modules\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use LabbeAramis\Modules\Exceptions\InvalidJsonException;
use Throwable;

class PublishClientConfigurationCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'app:publish-client-config';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish application client config files to the application';

    /**
     * Execute the console command.
     *
     */
    public function handle(): int
    {

        $this->publishConfig();

        return 0;
    }

    private function publishConfig(): bool
    {

        $defaultConfig = [
            'modules'    => [],
            'mainModule' => 'Main',
            'require'    => [],
        ];

        try {
            $config = $this->getConfig();
            if ( $config !== null && is_array( $config ) === true ) {
                $config = array_merge( $defaultConfig, $config );
            } else {
                $config = $defaultConfig;
            }
            $config['modules'] = $this->getModules();

            return $this->saveConfig( $config );
        } catch (Throwable $e) {
            return false;
        }
    }

    /**
     * @return array
     */
    private function getModules(): array
    {

        $modules = [];
        foreach ($this->laravel['modules']->allEnabled() as $module) {
            $modules[] = $module->getName();
        }

        return $modules;
    }

    /**
     * @return array|null
     * @throws InvalidJsonException
     */
    private function getConfig(): ?array
    {

        try {
            if ( File::exists( $this->getConfigPath() ) === true ) {
                return json_decode( File::get( $this->getConfigPath() ), true );
            } else {
                return null;
            }
        } catch (Throwable $e) {
            throw new InvalidJsonException( 'Invalid format of the config file' );
        }
    }

    /**
     * @param array $config
     *
     * @return bool
     * @throws InvalidJsonException
     */
    private function saveConfig( array $config ): bool
    {

        try {
            return File::put( $this->getConfigPath(), $this->formatConfig( json_encode( $config ) ) );

        } catch (Throwable $e) {
            throw new InvalidJsonException( 'Invalid format of the config file' );
        }
    }

    /**
     * @param string $config
     *
     * @return string
     */
    private function formatConfig( string $config ): string
    {

        $config = str_replace( '{', '{' . PHP_EOL, $config );
//        $config = str_replace( '}', '}' . PHP_EOL, $config );
        $config = str_replace( '[', '[' . PHP_EOL, $config );
//        $config = str_replace( ']', ']' . PHP_EOL, $config );
        $config = str_replace( ',', ',' . PHP_EOL, $config );

        return $config;
    }

    /**
     * @return string
     */
    private function getConfigPath(): string
    {

        return $pathConfig = base_path() . '/config.json';
    }
}
