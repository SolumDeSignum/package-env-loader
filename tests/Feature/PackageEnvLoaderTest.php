<?php

declare(strict_types=1);

namespace SolumDeSignum\PackageEnvLoader\Tests\Feature;

use Orchestra\Testbench\TestCase;
use SolumDeSignum\PackageEnvLoader\Contracts\PackageEnvLoaderContract;
use SolumDeSignum\PackageEnvLoader\Traits\PackageEnvLoader;

class PackageEnvLoaderTest extends TestCase implements PackageEnvLoaderContract
{
    use PackageEnvLoader;

    /**
     * Define the root path for the environment files.
     *
     * @param array $paths An array of path segments.
     * @return string|array
     */
    public function packageEnvRootPath(array $paths = [__DIR__ . '/..']): string|array
    {
        // Handle paths as array or string
        return $paths;
    }

    /**
     * @test
     */
    public function firstEnv(): void
    {
        // Adjusting to handle an array of paths
        $paths = $this->packageEnvRootPath();
        foreach ((array)$paths as $path) {
            $this->assertFileExists($path . '/.env.first.test');
        }
    }

    /**
     * @test
     */
    public function secondEnv(): void
    {
        // Adjusting to handle an array of paths
        $paths = $this->packageEnvRootPath();
        foreach ((array)$paths as $path) {
            $this->assertFileExists($path . '/.env.second.test');
        }
    }

    /**
     * @test
     */
    public function packageName(): void
    {
        $responsePackageDotenv = $this->createPackageDotenv(['.env.first.test']);
        $this->assertSame('PACKAGE_ENV_LOADER', env('PACKAGE_NAME_FIRST'));
    }

    /**
     * @test
     */
    public function packageDotenv(): void
    {
        $responsePackageDotenv = $this->createPackageDotenv(['.env.first.test']);
        $this->assertIsArray($responsePackageDotenv);
    }

    /**
     * @test
     */
    public function everything(): void
    {
        $paths = $this->packageEnvRootPath();
        foreach ((array)$paths as $path) {
            $this->assertFileExists($path . '/.env.first.test');
        }

        $responsePackageDotenv = $this->createPackageDotenv(['.env.first.test']);
        $this->assertIsArray($responsePackageDotenv);
        $this->assertSame('PACKAGE_ENV_LOADER', env('PACKAGE_NAME_FIRST'));
    }

    /**
     * @test
     */
    public function multipleEverything(): void
    {
        $paths = $this->packageEnvRootPath();
        foreach ((array)$paths as $path) {
            $this->assertFileExists($path . '/.env.first.test');
            $this->assertFileExists($path . '/.env.second.test');
        }

        $responsePackageDotenvFirst = $this->createPackageDotenv(['.env.first.test']);
        $this->assertIsArray($responsePackageDotenvFirst);
        $this->assertSame('PACKAGE_ENV_LOADER', env('PACKAGE_NAME_FIRST'));

        $responsePackageDotenvSecond = $this->createPackageDotenv(['.env.second.test']);
        $this->assertIsArray($responsePackageDotenvSecond);
        $this->assertSame('PACKAGE_ENV_LOADER_SECOND', env('PACKAGE_NAME_SECOND'));
    }
}
