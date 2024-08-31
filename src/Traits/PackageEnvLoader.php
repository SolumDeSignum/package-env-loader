<?php

declare(strict_types=1);

namespace SolumDeSignum\PackageEnvLoader\Traits;

use Dotenv\Dotenv;
use Dotenv\Exception\InvalidFileException;
use Illuminate\Support\Facades\Log;

trait PackageEnvLoader
{
    public function createPackageDotenv(array $environmentFiles = ['.env']): bool
    {
        $responseLoaded = true;

        foreach ($environmentFiles as $file) {
            try {
                Dotenv::createImmutable(
                    $this->packageEnvRootPath(),
                    $file
                )
                    ->safeLoad();

                Log::info("Loaded environment file: $file");
            } catch (InvalidFileException $e) {
                Log::error("Failed to load environment file $file: " . $e->getMessage());
                $responseLoaded = false;
            }
        }

        return $responseLoaded;
    }
}
