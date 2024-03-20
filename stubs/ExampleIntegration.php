<?php

declare(strict_types=1);

use SolumDeSignum\PackageEnvLoader\Contracts\PackageEnvLoaderContract;
use SolumDeSignum\PackageEnvLoader\Traits\PackageEnvLoader;

class ExampleIntegration implements PackageEnvLoaderContract
{
    use PackageEnvLoader;

    public mixed $packageEnv;

    /**
     * ExampleIntegration constructor.
     */
    public function __construct()
    {
        $this->packageEnv = $this->createPackageDotenv('.env.dev');
    }

    /**
     * Example of configuration.
     *
     * @param string $path
     *
     * @return string
     */
    public function packageEnvRootPath(string $path = '/..'): string
    {
        return __DIR__ . $path;
    }
}
