<?php

declare(strict_types=1);

namespace SolumDeSignum\PackageEnvLoader\Traits;

use Dotenv\Dotenv;

/**
 * Trait PackageEnvLoader
 * @package SolumDeSignum\PackageEnvLoader\Traits
 */
trait PackageEnvLoader
{
    /**
     * @return Dotenv
     */
    private function dotEnv(): Dotenv
    {
       return Dotenv::create($this->packageRootPath());
    }

    /**
     * @param string $path
     *
     * @return string
     */
    final public function packageRootPath(string $path = '/..' ): string
    {
        return __DIR__ . $path;
    }
}
