# Laravel Ticket System, to help you manage to tickets eaisly, and focus on building

[![Latest Version on Packagist](https://img.shields.io/packagist/v/coderflexx/laravel-ticket.svg?style=flat-square)](https://packagist.org/packages/coderflexx/laravel-ticket)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/coderflexx/laravel-ticket/run-tests?label=tests)](https://github.com/coderflexx/laravel-ticket/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/coderflexx/laravel-ticket/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/coderflexx/laravel-ticket/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/coderflexx/laravel-ticket.svg?style=flat-square)](https://packagist.org/packages/coderflexx/laravel-ticket)

## Installation

You can install the package via composer:

```bash
composer require coderflex/laravel-ticket
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="laravel-ticket-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-ticket-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="laravel-ticket-views"
```

## Usage

```php
$laravelTicket = new Coderflex\LaravelTicket();
echo $laravelTicket->echoPhrase('Hello, Coderflex!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [ousid](https://github.com/ousid)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
