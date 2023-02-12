<?php

declare(strict_types=1);

namespace SolumDeSignum\PackageEnvLoader\Tests\Unit;

use Orchestra\Testbench\TestCase;
use SolumDeSignum\PackageEnvLoader\Contracts\PackageEnvLoaderContract;
use SolumDeSignum\PackageEnvLoader\Traits\PackageEnvLoader;

class PackageEnvLoaderTest extends TestCase implements PackageEnvLoaderContract
{
    use PackageEnvLoader;

    final public function packageEnvRootPath(string $path = '/..'): string
    {
        return __DIR__ . $path;
    }

    /**
     * @test
     */
    final public function firstEnv(): void
    {
        $this->assertFileExists($this->packageEnvRootPath() . '/.env.first.test');
    }

    /**
     * @test
     */
    final public function secondEnv(): void
    {
        $this->assertFileExists($this->packageEnvRootPath() . '/.env.second.test');
    }

    /**
     * @test
     */
    final public function packageName(): void
    {
        $responsePackageDotenv = $this->createPackageDotenv('.env.first.test');
        $this->assertSame('PACKAGE_ENV_LOADER', env('PACKAGE_NAME_FIRST'));
    }

    /**
     * @test
     */
    final public function packageDotenv(): void
    {
        $responsePackageDotenv = $this->createPackageDotenv('.env.first.test');
        $this->assertIsArray($responsePackageDotenv);
    }

    /**
     * @test
     */
    final public function everything(): void
    {
        $this->assertFileExists($this->packageEnvRootPath() . '/.env.first.test');

        $responsePackageDotenv = $this->createPackageDotenv('.env.first.test');
        $this->assertIsArray($responsePackageDotenv);

        $this->assertSame('PACKAGE_ENV_LOADER', env('PACKAGE_NAME_FIRST'));
    }

    /**
     * @test
     */
    final public function multipleEverything(): void
    {
        $this->assertFileExists($this->packageEnvRootPath() . '/.env.first.test');
        $this->assertFileExists($this->packageEnvRootPath() . '/.env.second.test');

        $responsePackageDotenvFirst = $this->createPackageDotenv('.env.first.test');
        $this->assertIsArray($responsePackageDotenvFirst);
        $this->assertSame('PACKAGE_ENV_LOADER', env('PACKAGE_NAME_FIRST'));

        $responsePackageDotenvSecond = $this->createPackageDotenv('.env.second.test');
        $this->assertIsArray($responsePackageDotenvSecond);
        $this->assertSame('PACKAGE_ENV_LOADER_SECOND', env('PACKAGE_NAME_SECOND'));
    }
}
