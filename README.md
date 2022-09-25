<p align="center">
    <img src="art/logo.png" alt="Laravisit Logo" width="300">
    <br><br>
</p>

[![Latest Version on Packagist](https://img.shields.io/packagist/v/coderflexx/laravel-ticket.svg?style=flat-square)](https://packagist.org/packages/coderflexx/laravel-ticket)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/coderflexx/laravel-ticket/run-tests?label=tests)](https://github.com/coderflexx/laravel-ticket/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/coderflexx/laravel-ticket/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/coderflexx/laravel-ticket/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/coderflexx/laravel-ticket.svg?style=flat-square)](https://packagist.org/packages/coderflexx/laravel-ticket)


## Introduction
__Laravel Ticket__ package, is a an Backend API to handle your ticket system, with an easy way.

## Installation

You can install the package via composer:

```bash
composer require coderflex/laravel-ticket
```

## Configuration

You can publish the config file with:

```bash
php artisan vendor:publish --tag="ticket-config"
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="ticket-migrations"
```
Before Running the migration, you may publish the config file, and make sure the current tables does not make a confilict with your existing application, and once you are happy with the migration table, you can run

```bash
php artisan migrate
```

## Usage

The Basic Usage of this package, is to create a `ticket`, then associate the `labels` and the `categories` to it.

You can associate as many as `categories`/`labels` into a single ticket.

Here is an example

```php
use Coderflex\LaravelTicket\Models\Ticket;
use Coderflex\LaravelTicket\Models\Category;
use Coderflex\LaravelTicket\Models\Label;

...
public function store(Request $request)
{
    /** @var User */
    $user = Auth::user();

    $ticket = $user->tickets()
                    ->create($request->validated());

    $categories = Category::first();
    $labels = Label::first();

    $ticket->attachCategories($categories);
    $ticket->attachLabels($labels);
    
    // or you can create the categories & the tickets directly by:
    // $ticket->categories()->create(...);
    // $ticket->labels()->create(...);

    return redirect(route('tickets.show', $ticket->uuid))
            ->with('success', __('Your Ticket Was created successfully.'));
}
...
```
### Ticket Table Structure

| Column Name  | Type  |  Default  |
|---|---|---|
|  id |`integer` | `NOT NULL`  |
|  uuid |`string` | `NULL`  |
|  user_id |`integer` | `NOT NULL`  |
|  title |`string` | `NOT NULL`  |
|  message |`string` | `NULL`  |
|  priority |`string` | `low`  |
|  status |`string` | `open`  |
|  is_resolved |`boolean` | `false`  |
|  is_locked |`boolean` | `false`  |
|  created_at |`timestamp` | `NULL`  |
|  updated_at |`timestamp` | `NULL`  |

### Message Table Structure

| Column Name  | Type  |  Default  |
|---|---|---|
|  id |`integer` | `NOT NULL`  |
|  user_id |`integer` | `NOT NULL`  |
|  ticket_id |`integer` | `NOT NULL`  |
|  message |`string` | `NULL`  |
|  created_at |`timestamp` | `NULL`  |
|  updated_at |`timestamp` | `NULL`  |

### Label Table Structure

| Column Name  | Type  |  Default  |
|---|---|---|
|  id |`integer` | `NOT NULL`  |
|  name |`string` | `NULL`  |
|  slug |`string` | `NULL`  |
|  is_visible |`boolean` | `false`  |
|  created_at |`timestamp` | `NULL`  |
|  updated_at |`timestamp` | `NULL`  |

### Category Table Structure

| Column Name  | Type  |  Default  |
|---|---|---|
|  id |`integer` | `NOT NULL`  |
|  name |`string` | `NULL`  |
|  slug |`string` | `NULL`  |
|  is_visible |`boolean` | `false`  |
|  created_at |`timestamp` | `NULL`  |
|  updated_at |`timestamp` | `NULL`  |

## API Methods

### Ticket API Methods
The `ticket` model came with a handy methods to use, to make your building process easy and fast, and here is the list of the availabel __API__:

| Method  | Arguments  |  Example | Description  | Chainable |
|---|---|---|---|---|
|  `archive` |`void` | archive the ticket  | `$ticket->archive()` | ✓
|  `close` |`void` | close the ticket  | `$ticket->close()` | ✓
|  `reopen` |`void` | reopen a closed ticket  | `$ticket->reopen()` | ✓
|  `markAsResolved` |`void` | mark the ticket as resolved  | `$ticket->markAsResolved()` | ✓
|  `markAsLocked` |`void` | mark the ticket as locked  | `$ticket->markAsLocked()` | ✓
|  `markAsUnlocked` |`void` | mark the ticket as unlocked  | `$ticket->markAsUnlocked()` | ✓
|  `markAsArchived` |`void` | mark the ticket as archived  | `$ticket->markAsArchived()` | ✓
|  `closeAsResolved` |`void` | close the ticket and marked it as resolved  | `$ticket->closeAsResolved()` | ✓
|  `closeAsUnresolved` |`void` | close the ticket and marked it as unresolved  | `$ticket->closeAsUnresolved()` | ✓
|  `reopenAsUnresolved` |`void` | reopen the ticket and marked it as unresolved  | `$ticket->reopenAsUnresolved()` | ✓
|  `isArchived` |`void` | check if the ticket archived  | `$ticket->isArchived()` | ✗
|  `isOpen` |`void` | check if the ticket open  | `$ticket->isOpen()` | ✗
|  `isClosed` |`void` | check if the ticket closed  | `$ticket->isClosed()` | ✗
|  `isResolved` |`void` | check if the ticket has a resolved status  | `$ticket->isResolved()` | ✗
|  `isUnresolved` |`void` | check if the ticket has a unresolved status  | `$ticket->isUnresolved()` | ✗
|  `isLocked` |`void` | check if the ticket is locked  | `$ticket->isLocked()` | ✗
|  `isUnlocked` |`void` | check if the ticket is unlocked  | `$ticket->isUnlocked()` | ✗

The __Chainable__ column, is showing the state for the method, that if it can be chained or not, something like
```php
    $ticket->archive()
            ->close()
            ->markAsResolved();
```
## Ticket Relashionship API Methods
The `ticket` model has also a list of methods for interacting with another related models

| Method  | Arguments  |  Example  |  Description  |
|---|---|---|---|
|  `attachLabels` |`mixed` id, `array` attributes, `bool` touch | associate labels into an existing ticket  | `$ticket->attachLabels([1,2,3,4])` |
|  `syncLabels` |`Model/array` ids, `bool` detouching | associate labels into an existing ticket  | `$ticket->syncLabels([1,2,3,4])` |
|  `attachCategories` |`mixed` id, `array` attributes, `bool` touch | associate categories into an existing ticket  | `$ticket->attachCategories([1,2,3,4])` |
|  `syncCategories` |`Model/array` ids, `bool` detouching | associate categories into an existing ticket  | `$ticket->syncCategories([1,2,3,4])` |
|  `message` |`string` message | add new message on an existing ticket  | `$ticket->message('A message in a ticket')` |
|  `messageAsUser` |`Model/null` user, `string` message | add new message on an existing ticket as a deffrent user  | `$ticket->messageAsUser($user, 'A message in a ticket')` |

> The `attachCategories` and `syncCategories` methods, is an alternative for `attach` and `sync` laravel methods, and if you want to learn more, please take a look at this [link](https://laravel.com/docs/9.x/eloquent-relationships#attaching-detaching)

The `commentAsUser` accepts a user as a first argument, if it's null, the __authenticated__ user will be user as default.

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
