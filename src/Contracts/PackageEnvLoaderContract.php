<?php

declare(strict_types=1);

namespace SolumDeSignum\PackageEnvLoader\Contracts;

interface PackageEnvLoaderContract
{
    /**
     * @return string
     */
    public function packageEnvRootPath(): string;
}
