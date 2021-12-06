# Types Enums for Doctrine

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Software License][ico-license]](LICENSE)

Provides Doctrine types for "mediagone/types-enums" package.


## Installation
This package requires **PHP 7.4+** and Doctrine **DBAL 2.7+**

Add it as Composer dependency:
```sh
$ composer require mediagone/types-enums-doctrine
```


## Configuration
This package provides a generic Doctrine type to remove the need to create a custom types for each enum class manually. Then, you only need to register your enums in the `DoctrineEnumTypesLoader` class, and custom types will be automatically created and registered for you.

### With Symfony
If you're using this package in a Symfony project, register your enum classes in your app's kernel class:
```php
use App\MyCustomEnum;
use App\MyOtherEnum;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public function boot(): void
    {
        parent::boot();

        (new DoctrineEnumTypesLoader())->registerEnumTypes([
            MyCustomEnum::class,
            MyOtherEnum::class,
            // any other enum classes here
        ]);
    }

    ...
}
```


## License

_Types Enums for Doctrine_ is licensed under MIT license. See LICENSE file.



[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg
[ico-version]: https://img.shields.io/packagist/v/mediagone/types-enums-doctrine.svg
[ico-downloads]: https://img.shields.io/packagist/dt/mediagone/types-enums-doctrine.svg

[link-packagist]: https://packagist.org/packages/mediagone/types-enums-doctrine
[link-downloads]: https://packagist.org/packages/mediagone/types-enums-doctrine
