[![StyleCI](https://github.styleci.io/repos/326276520/shield?branch=master)](https://github.styleci.io/repos/145921620)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/solumdesignum/package-env-loader/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/solumdesignum/package-env-loader/?branch=master)
[![Total Downloads](https://poser.pugx.org/solumdesignum/package-env-loader/downloads)](https://packagist.org/packages/solumdesignum/package-env-loader)
[![Latest Stable Version](https://poser.pugx.org/solumdesignum/package-env-loader/v/stable)](https://packagist.org/packages/solumdesignum/package-env-loader)
[![Latest Unstable Version](https://poser.pugx.org/solumdesignum/package-env-loader/v/unstable)](https://packagist.org/packages/solumdesignum/package-env-loader)
[![MIT Licensed](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

## Introduction
Framework agnostic environment loader that abstracts PHP dotEnv for faster env loading.

## Installation
To get started, install PackageEnvLoader using the Composer package manager:
```shell
composer require solumdesignum/package-env-loader
```

## Origins
I created this package because, I was very frustrated with this issue that I can't 
share my .env file between javascript frameworks due to this package was born.

## Usage
```php
<?php

declare(strict_types=1);

use SolumDeSignum\PackageEnvLoader\Contracts\PackageEnvLoaderContract;
use SolumDeSignum\PackageEnvLoader\Traits\PackageEnvLoader;

class ExampleIntegration implements PackageEnvLoaderContract
{
    use PackageEnvLoader;

    /**
    * @var array 
     */
    private array $packageEnv;

    /**
    * ExampleIntegration constructor.
     */
    public function __construct()
    {
        $this->packageEnv = $this->createPackageDotenv('.env');
    }

    /**
     * Example of configuration
     *
     * @param string $path
     *
     * @return string
     */
    final public function packageEnvRootPath(string $path = '/..'): string
    {
        return __DIR__ . $path;
    }
}
````

## Contributing
Thank you for considering contributing to the PackageEnvLoader. You can read 
the 
contribution guidelines [here](CONTRIBUTING.md)

## Security
If you discover any security-related issues, please email to [Solum DeSignum](mailto:oskars_germovs@inbox.lv).

## Credits
- [Oskars Germovs](https://github.com/Faks)

## About
[Solum DeSignum](https://solum-designum.eu) is a web design agency based in Latvia, Riga.

## License
PackageEnvLoader is open-sourced software licensed under the [MIT license](LICENSE.md)
