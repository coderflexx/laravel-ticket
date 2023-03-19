<p align="center">
    <img src="art/logo.png" alt="Laravisit Logo" width="300">
    <br><br>
</p>

[![Latest Version on Packagist](https://img.shields.io/packagist/v/coderflex/laravel-ticket.svg?style=flat-square)](https://packagist.org/packages/coderflex/laravel-ticket)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/coderflexx/laravel-ticket/run-tests.yml?branch=main&label=test)](https://github.com/coderflexx/laravel-ticket/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/coderflexx/laravel-ticket/phpstan.yml?branch=main&label=code%20style)](https://github.com/coderflexx/laravel-ticket/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/coderflex/laravel-ticket.svg?style=flat-square)](https://packagist.org/packages/coderflex/laravel-ticket)

- [Introduction](#introduction)
- [Installation](#installation)
- [Configuration](#configuration)
- [Preparing your model](#preparing-your-model)
- [Usage](#usage)
  - [Ticket Table Structure](#ticket-table-structure)
  - [Message Table Structure](#message-table-structure)
  - [Label Table Structure](#label-table-structure)
  - [Category Table Structure](#category-table-structure)
- [API Methods](#api-methods)
  - [Ticket API Methods](#ticket-api-methods)
  - [Ticket Relationship API Methods](#ticket-relationship-api-methods)
  - [Ticket Scopes](#ticket-scopes)
  - [Category \& Label Scopes](#category--label-scopes)
- [Handling File Upload](#handling-file-upload)
- [Testing](#testing)
- [Changelog](#changelog)
- [Contributing](#contributing)
- [Security Vulnerabilities](#security-vulnerabilities)
- [Credits](#credits)
- [License](#license)

## Introduction
__Laravel Ticket__ package, is a Backend API to handle your ticket system, with an easy way.

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
Before Running the migration, you may publish the config file, and make sure the current tables does not make a conflict with your existing application, and once you are happy with the migration table, you can run

```bash
php artisan migrate
```

## Preparing your model

Add `HasTickets` trait into your `User` model, along with `CanUseTickets` interface

```php
...
use Coderflex\LaravelTicket\Concerns\HasTickets;
use Coderflex\LaravelTicket\Contracts\CanUseTickets;
...
class User extends Model implements CanUseTickets
{
    ...
    use HasTickets;
    ...
}
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

public function createLabel()
{
    // If you create a label seperated from the ticket and wants to
    // associate it to a ticket, you may do the following.
    $label = Label::create(...);

    $label->tickets()->attach($ticket);

    // or maybe 
    $label->tickets()->detach($ticket);
}

public function createCategory()
{
    // If you create a category/categories seperated from the ticket and wants to
    // associate it to a ticket, you may do the following.
    $category = Category::create(...);

    $category->tickets()->attach($ticket);

    // or maybe 
    $category->tickets()->detach($ticket);
}
...
```

### Ticket Table Structure

| Column Name  | Type  |  Default  |
|---|---|---|
|  ID |`integer` | `NOT NULL`  |
|  UUID |`string` | `NULL`  |
|  user_id |`integer` | `NOT NULL`  |
|  title |`string` | `NOT NULL`  |
|  message |`string` | `NULL`  |
|  priority |`string` | `low`  |
|  status |`string` | `open`  |
|  is_resolved |`boolean` | `false`  |
|  is_locked |`boolean` | `false`  |
| assigned_to | `integer` | `NULL` |
|  created_at |`timestamp` | `NULL`  |
|  updated_at |`timestamp` | `NULL`  |

### Message Table Structure

| Column Name  | Type  |  Default  |
|---|---|---|
|  ID |`integer` | `NOT NULL`  |
|  user_id |`integer` | `NOT NULL`  |
|  ticket_id |`integer` | `NOT NULL`  |
|  message |`string` | `NULL`  |
|  created_at |`timestamp` | `NULL`  |
|  updated_at |`timestamp` | `NULL`  |

### Label Table Structure

| Column Name  | Type  |  Default  |
|---|---|---|
|  ID |`integer` | `NOT NULL`  |
|  name |`string` | `NULL`  |
|  slug |`string` | `NULL`  |
|  is_visible |`boolean` | `false`  |
|  created_at |`timestamp` | `NULL`  |
|  updated_at |`timestamp` | `NULL`  |

### Category Table Structure

| Column Name  | Type  |  Default  |
|---|---|---|
|  ID |`integer` | `NOT NULL`  |
|  name |`string` | `NULL`  |
|  slug |`string` | `NULL`  |
|  is_visible |`boolean` | `false`  |
|  created_at |`timestamp` | `NULL`  |
|  updated_at |`timestamp` | `NULL`  |

## API Methods

### Ticket API Methods
The `ticket` model came with handy methods to use, to make your building process easy and fast, and here is the list of the available __API__:

| Method               | Arguments  | Description                                   | Example                                             | Chainable |
|----------------------|---|-----------------------------------------------|-----------------------------------------------------|---|
| `archive`            |`void` | archive the ticket                            | `$ticket->archive()`                                | ✓
| `close`              |`void` | close the ticket                              | `$ticket->close()`                                  | ✓
| `reopen`             |`void` | reopen a closed ticket                        | `$ticket->reopen()`                                 | ✓
| `markAsResolved`     |`void` | mark the ticket as resolved                   | `$ticket->markAsResolved()`                         | ✓
| `markAsLocked`       |`void` | mark the ticket as locked                     | `$ticket->markAsLocked()`                           | ✓
| `markAsUnlocked`     |`void` | mark the ticket as unlocked                   | `$ticket->markAsUnlocked()`                         | ✓
| `markAsArchived`     |`void` | mark the ticket as archived                   | `$ticket->markAsArchived()`                         | ✓
| `closeAsResolved`    |`void` | close the ticket and marked it as resolved    | `$ticket->closeAsResolved()`                        | ✓
| `closeAsUnresolved`  |`void` | close the ticket and marked it as unresolved  | `$ticket->closeAsUnresolved()`                      | ✓
| `reopenAsUnresolved` |`void` | reopen the ticket and marked it as unresolved | `$ticket->reopenAsUnresolved()`                     | ✓
| `isArchived`         |`void` | check if the ticket archived                  | `$ticket->isArchived()`                             | ✗
| `isOpen`             |`void` | check if the ticket open                      | `$ticket->isOpen()`                                 | ✗
| `isClosed`           |`void` | check if the ticket closed                    | `$ticket->isClosed()`                               | ✗
| `isResolved`         |`void` | check if the ticket has a resolved status     | `$ticket->isResolved()`                             | ✗
| `isUnresolved`       |`void` | check if the ticket has an unresolved status  | `$ticket->isUnresolved()`                           | ✗
| `isLocked`           |`void` | check if the ticket is locked                 | `$ticket->isLocked()`                               | ✗
| `isUnlocked`         |`void` | check if the ticket is unlocked               | `$ticket->isUnlocked()`                             | ✗
| `assignTo`           |`void` | assign ticket to a user                       | `$ticket->assignTo($user)` or `$ticket->assignTo(2)` | ✓
| `makePriorityAsLow`  |`void` | make ticket priority as low                   | `$ticket->makePriorityAsLow()`                      | ✓
| `makePriorityAsNormal`|`void`| make ticket priority as normal                | `$ticket->makePriorityAsNormal()`                   | ✓
| `makePriorityAsHigh` |`void` | make ticket priority as high                  | `$ticket->makePriorityAsHigh()`                     | ✓

The __Chainable__ column, is showing the state for the method, that if it can be chained or not, something like
```php
    $ticket->archive()
            ->close()
            ->markAsResolved();
```
### Ticket Relationship API Methods
The `ticket` model has also a list of methods for interacting with another related models

| Method  | Arguments  |  Description  |  Example  |
|---|---|---|---|
|  `attachLabels` |`mixed` ID, `array` attributes, `bool` touch | associate labels into an existing ticket  | `$ticket->attachLabels([1,2,3,4])` |
|  `syncLabels` |`Model/array` IDs, `bool` detouching | associate labels into an existing ticket  | `$ticket->syncLabels([1,2,3,4])` |
|  `attachCategories` |`mixed` ID, `array` attributes, `bool` touch | associate categories into an existing ticket  | `$ticket->attachCategories([1,2,3,4])` |
|  `syncCategories` |`Model/array` IDs, `bool` detouching | associate categories into an existing ticket  | `$ticket->syncCategories([1,2,3,4])` |
|  `message` |`string` message | add new message on an existing ticket  | `$ticket->message('A message in a ticket')` |
|  `messageAsUser` |`Model/null` user, `string` message | add new message on an existing ticket as a different user  | `$ticket->messageAsUser($user, 'A message in a ticket')` |

> The `attachCategories` and `syncCategories` methods, is an alternative for `attach` and `sync` laravel methods, and if you want to learn more, please take a look at this [link](https://laravel.com/docs/9.x/eloquent-relationships#attaching-detaching)

The `commentAsUser` accepts a user as a first argument, if it's null, the __authenticated__ user will be user as default.

### Ticket Scopes
The `ticket` model has also a list of scopes to begin filter with.

| Method  | Arguments  |  Description  |  Example  |
|---|---|---|---|
|  `closed` |`void` | get the closed tickets  | `Ticket::closed()->get()` |
|  `opened` |`void` | get the opened tickets  | `Ticket::opened()->get()` |
|  `resolved` |`void` | get the resolved tickets  | `Ticket::resolved()->get()` |
|  `locked` |`void` | get the locked tickets  | `Ticket::locked()->get()` |
|  `unlocked` |`void` | get the unlocked tickets  | `Ticket::unlocked()->get()` |
|  `withLowPriority` |`void` | get the low priority tickets  | `Ticket::withLowPriority()->get()` |
|  `withNormalPriority` |`void` | get the normal priority tickets  | `Ticket::withNormalPriority()->get()` |
|  `withHighPriority` |`void` | get the high priority tickets  | `Ticket::withHighPriority()->get()` |
|  `withPriority` |`string` $priority | get the withPriority tickets  | `Ticket::withPriority('critical')->get()` |

### Category & Label Scopes
| Method  | Arguments  |  Description  |  Example  |
|---|---|---|---|
|  `visible` |`void` | get the visible model records  | `Label::visible()->get()` |
|  `hidden` |`void` | get the hidden model records  | `Category::visible()->get()` |

## Handling File Upload
This package doesn't come with file upload feature (yet) Instead you can use [laravel-medialibrary](https://github.com/spatie/laravel-medialibrary) by __Spatie__,
to handle file functionality.

The steps are pretty straight forward, all what you need to do is the following.

Extends the `Ticket` model, by creating a new model file in your application by
```
php artisan make:model Ticket
```

Then extend the base `Ticket Model`, then use `InteractWithMedia` trait by spatie package, and the interface `HasMedia`:

```php
namespace App\Models\Ticket;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Ticket extends \Coderflex\LaravelTicket\Models\Ticket implements HasMedia
{
    use InteractsWithMedia;
}
```

The rest of the implementation, head to [the docs](https://spatie.be/docs/laravel-medialibrary/v10/introduction) of spatie package to know more.

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
