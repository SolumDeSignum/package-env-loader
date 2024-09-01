<?php

declare(strict_types=1);

namespace SolumDeSignum\PackageEnvLoader\Tests\Feature;

use Orchestra\Testbench\TestCase;
use SolumDeSignum\PackageEnvLoader\Contracts\PackageEnvLoaderContract;
use SolumDeSignum\PackageEnvLoader\Enums\EnvironmentVariableEnum;
use SolumDeSignum\PackageEnvLoader\Traits\PackageEnvLoader;

class PackageEnvLoaderTest extends TestCase implements PackageEnvLoaderContract
{
    use PackageEnvLoader;

    private array $env = [
        'first' => EnvironmentVariableEnum::FIRST->value,
        'second' => EnvironmentVariableEnum::SECOND->value
    ];

    protected function setUp(): void
    {
        parent::setUp();
        $this->forgetEnvironmentVariables();
    }

    protected function tearDown(): void
    {
        $this->forgetEnvironmentVariables();
        parent::tearDown();
    }

    /**
     * @test
     */
    public function firstEnvExist(): void
    {
        foreach ($this->packageEnvRootPath() as $path) {
            $this->assertFileExists($path . '/' . $this->env['first']);
        }
    }

    /**
     * @test
     */
    public function secondEnvExist(): void
    {
        foreach ($this->packageEnvRootPath() as $path) {
            $this->assertFileExists($path . '/' . $this->env['second']);
        }
    }

    /**
     * @test
     */
    public function firstEnvIsLoaded(): void
    {
        $responsePackageDotenv = $this->createPackageDotenv([$this->env['first']]);
        $this->assertIsArray($responsePackageDotenv);
        $this->assertArrayHasKey('PACKAGE_NAME_FIRST', $responsePackageDotenv);
        $this->assertSame('PACKAGE_ENV_LOADER', env('PACKAGE_NAME_FIRST'));
    }

    /**
     * @test
     */
    public function secondEnvIsLoaded(): void
    {
        $responsePackageDotenv = $this->createPackageDotenv([$this->env['second']]);
        $this->assertIsArray($responsePackageDotenv);
        $this->assertArrayHasKey('PACKAGE_NAME_SECOND', $responsePackageDotenv);
        $this->assertSame('PACKAGE_ENV_LOADER_SECOND', env('PACKAGE_NAME_SECOND'));
    }

    /**
     * @test
     */
    public function firstEnvExistAndIsLoaded(): void
    {
        foreach ($this->packageEnvRootPath() as $path) {
            $this->assertFileExists($path . '/' . $this->env['first']);
        }

        $responsePackageDotenv = $this->createPackageDotenv([$this->env['first']]);
        $this->assertIsArray($responsePackageDotenv);
        $this->assertArrayHasKey('PACKAGE_NAME_FIRST', $responsePackageDotenv);
        $this->assertSame('PACKAGE_ENV_LOADER', env('PACKAGE_NAME_FIRST'));
    }

    /**
     * @test
     */
    public function secondEnvExistAndIsLoaded(): void
    {
        foreach ($this->packageEnvRootPath() as $path) {
            $this->assertFileExists($path . '/' . $this->env['second']);
        }

        $responsePackageDotenv = $this->createPackageDotenv([$this->env['second']]);
        $this->assertIsArray($responsePackageDotenv);
        $this->assertArrayHasKey('PACKAGE_NAME_SECOND', $responsePackageDotenv);
        $this->assertSame('PACKAGE_ENV_LOADER_SECOND', env('PACKAGE_NAME_SECOND'));
    }

    /**
     * @test
     */
    public function multipleEverything(): void
    {
        foreach ($this->packageEnvRootPath() as $path) {
            $this->assertFileExists($path . '/' . $this->env['first']);
            $this->assertFileExists($path . '/' . $this->env['second']);
        }

        $responsePackageDotenv = $this->createPackageDotenv([
            $this->env['first'],
            $this->env['second']
        ]);

        $this->assertIsArray($responsePackageDotenv);

        $this->assertArrayHasKey('PACKAGE_NAME_FIRST', $responsePackageDotenv);
        $this->assertSame('PACKAGE_ENV_LOADER', env('PACKAGE_NAME_FIRST'));

        $this->assertArrayHasKey('PACKAGE_NAME_SECOND', $responsePackageDotenv);
        $this->assertSame('PACKAGE_ENV_LOADER_SECOND', env('PACKAGE_NAME_SECOND'));
    }

    public function packageEnvRootPath(array $paths = [__DIR__ . '/..']): array
    {
        return $paths;
    }

    private function forgetEnvironmentVariables(): void
    {
        putenv('PACKAGE_NAME_FIRST');
        putenv('PACKAGE_NAME_SECOND');
        $_ENV = [];
        $_SERVER = [];
    }
}
