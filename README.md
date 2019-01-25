# Laravel Handlers

[![Latest Version](https://img.shields.io/packagist/v/oanhnn/laravel-handlers.svg)](https://packagist.org/packages/oanhnn/laravel-handlers)
[![Software License](https://img.shields.io/github/license/oanhnn/laravel-handlers.svg)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/oanhnn/laravel-handlers/master.svg)](https://travis-ci.org/oanhnn/laravel-handlers)
[![Coverage Status](https://img.shields.io/coveralls/github/oanhnn/laravel-handlers/master.svg)](https://coveralls.io/github/oanhnn/laravel-handlers?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/oanhnn/laravel-handlers.svg)](https://packagist.org/packages/oanhnn/laravel-handlers)
[![Requires PHP](https://img.shields.io/travis/php-v/oanhnn/laravel-handlers.svg)](https://travis-ci.org/oanhnn/laravel-handlers)

Using handler class instead of controller class in Laravel 5.5+

## Requirements

* php >=7.1.3
* Laravel 5.5+

## TODO

- [ ] Write test classes
- [ ] Write documents

## Installation

Begin by pulling in the package through Composer.

```bash
$ composer require oanhnn/laravel-handlers
```

### Laravel

After that, publish vendor's resources:

```bash
$ php artisan vendor:publish --provider="Laravel\\Handlers\\ServiceProvider" --tag=config
```

If you want customize stub file, please run:

```bash
$ php artisan vendor:publish --provider="Laravel\\Handlers\\ServiceProvider" --tag=stubs
```

### Lumen

After that, copy the config file from the vendor directory:

```bash
$ cp vendor/oanhnn/laravel-handlers/config/handlers.php config/handlers.php
```

Register the config file and the service provider in `bootstrap/app.php`:

```php
$app->configure('handlers');

$app->register(Laravel\Handlers\ServiceProvider::class);
```

## Usage

### Create handler class

Create new handler class by run command

```bash
$ php artisan make:handler ShowProfile
```

You can use `--force` option to force create handler class

```bash
$ php artisan make:handler --force ShowProfile
```

### Configure

You can change namespace of handler classes by config `namespace` in `config/handlers.php` file.

```php
    'namespace' => '\\App\\Http\\Api',
```

### Custom handler stub



## Changelog

See all change logs in [CHANGELOG](CHANGELOG.md)

## Testing

```bash
$ git clone git@github.com/oanhnn/laravel-handlers.git /path
$ cd /path
$ composer install
$ composer phpunit
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email to [Oanh Nguyen](mailto:oanhnn.bk@gmail.com) instead of 
using the issue tracker.

## Credits

- [Oanh Nguyen](https://github.com/oanhnn)
- [All Contributors](../../contributors)

## License

This project is released under the MIT License.   
Copyright © 2018 [Oanh Nguyen](https://oanhnn.github.io/).
