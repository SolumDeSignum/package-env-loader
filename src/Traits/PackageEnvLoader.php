<?php

declare(strict_types=1);

namespace SolumDeSignum\PackageEnvLoader\Traits;

use Dotenv\Dotenv;
use Dotenv\Exception\InvalidFileException;
use Illuminate\Support\Facades\Log;
use LogicException;
use SolumDeSignum\PackageEnvLoader\Contracts\PackageEnvLoaderContract;

trait PackageEnvLoader
{
    public function createPackageDotenv(array $environmentFiles = ['.env']): array
    {
        if (!($this instanceof PackageEnvLoaderContract)) {
            throw new LogicException(
                'Class must implement PackageEnvLoaderContract to use method createPackageDotenv.'
            );
        }

        $responsePackage = [];

        foreach ($environmentFiles as $environmentFile) {
            try {
                $response = Dotenv::createImmutable(
                    $this->packageEnvRootPath(),
                    $environmentFile
                )->safeLoad();

                Log::info("Loaded environment file: $environmentFile");
            } catch (InvalidFileException $e) {
                Log::error("Failed to load environment file $environmentFile: " . $e->getMessage());
                $response = false;
            }

            $responsePackage[] = $response;
        }

        $flattenedResponses = [];
        foreach ($responsePackage as $response) {
            if (is_array($response)) {
                $flattenedResponses = array_merge($flattenedResponses, $response);
            }
        }

        return $flattenedResponses;
    }
}
