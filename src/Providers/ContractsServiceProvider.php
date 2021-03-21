<?php

namespace LabbeAramis\Modules\Providers;

use Illuminate\Support\ServiceProvider;
use LabbeAramis\Modules\Contracts\RepositoryInterface;
use LabbeAramis\Modules\Laravel\LaravelFileRepository;

class ContractsServiceProvider extends ServiceProvider
{
    /**
     * Register some binding.
     */
    public function register()
    {
        $this->app->bind(RepositoryInterface::class, LaravelFileRepository::class);
    }
}
