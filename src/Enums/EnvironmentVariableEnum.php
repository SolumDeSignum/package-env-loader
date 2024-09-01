<?php

declare(strict_types=1);

namespace SolumDeSignum\PackageEnvLoader\Enums;

enum EnvironmentVariableEnum: string
{
    case FIRST = '.env.first.test';
    case SECOND = '.env.second.test';
}
