<?php

declare(strict_types=1);

namespace SolumDeSignum\PackageEnvLoader\Contracts;

interface PackageEnvLoaderContract
{
    public function packageEnvRootPath(array $paths): array;
}
