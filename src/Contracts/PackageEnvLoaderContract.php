<?php

declare(strict_types=1);

namespace SolumDeSignum\PackageEnvLoader\Contracts;

/**
 * Interface PackageEnvLoaderContract
 * @package SolumDeSignum\LanguagesI18n\Contracts
 */
interface PackageEnvLoaderContract
{
    /**
     * @return string
     */
    public function packageRootPath(): string;
}
