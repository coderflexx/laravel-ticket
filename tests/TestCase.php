<?php

namespace Coderflex\LaravelTicket\Tests;

use Coderflex\LaravelTicket\LaravelTicketServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        config()->set('app.key', '6rE9Nz59bGRbeMATftriyQjrpF7DcOQm');

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Coderflex\\LaravelTicket\\Tests\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelTicketServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        $migrations = [
            include __DIR__.'/../database/migrations/create_tickets_table.php.stub',
            include __DIR__.'/../database/migrations/create_categories_table.php.stub',
            include __DIR__.'/../database/migrations/create_messages_table.php.stub',
            include __DIR__.'/../database/migrations/create_labels_table.php.stub',

            // Many to Many tables
            include __DIR__.'/../database/migrations/create_label_ticket_table.php.stub',
            include __DIR__.'/../database/migrations/create_category_ticket_table.php.stub',

            // Tests Migration
            include __DIR__.'/Database/Migrations/create_users_table.php',
        ];

        collect($migrations)->each(fn ($migration) => $migration->up());
    }
}
