<?php

declare(strict_types=1);

namespace SolumDeSignum\PackageEnvLoader\Traits;

use Dotenv\Dotenv;
use Dotenv\Exception\InvalidFileException;
use Illuminate\Support\Env;

trait PackageEnvLoader
{
    /**
     * @param string $environmentFile
     *
     * @return null[]|string|string[]
     */
    final public function createPackageDotenv(string $environmentFile = '.env')
    {
        try {
            $response = Dotenv::create(
                Env::getRepository(),
                $this->packageEnvRootPath(),
                $environmentFile
            )
                ->load();
        } catch (InvalidFileException $e) {
            $response = $e->getMessage();
        }

        return $response;
    }
}
