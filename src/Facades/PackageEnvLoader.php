<?php

declare(strict_types=1);

namespace SolumDeSignum\PackageEnvLoader\Facades;

use Illuminate\Support\Facades\Facade;

class PackageEnvLoader extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'package-env-loader';
    }
}
