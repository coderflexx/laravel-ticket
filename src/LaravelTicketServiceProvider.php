<?php

namespace Coderflex\LaravelTicket;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelTicketServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-ticket')
            ->hasConfigFile()
            ->hasMigrations(
                'create_laravel_tickets_table',
                'create_ticket_comments_table',
                'create_ticket_categories_table',
                'create_ticket_labels_table',
            );
    }
}
