# Introduction

[![Build Status](https://travis-ci.org/oanhnn/laravel-handlers.svg?branch=master)](https://travis-ci.org/oanhnn/laravel-handlers)
[![Coverage Status](https://coveralls.io/repos/github/oanhnn/laravel-handlers/badge.svg?branch=master)](https://coveralls.io/github/oanhnn/laravel-handlers?branch=master)

Easy fake model ID on URL Laravel 5.5+ Application

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

After that, publish vendor's resources:

```bash
$ php artisan vendor:publish --provider="Laravel\\Handlers\\HandlersServiceProvider" --tag=config
$ php artisan vendor:publish --provider="Laravel\\Handlers\\HandlersServiceProvider" --tag=routes
```

If you want customize stub file, please run:

```bash
$ php artisan vendor:publish --provider="Laravel\\Handlers\\HandlersServiceProvider" --tag=stubs
```

## Usage


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
