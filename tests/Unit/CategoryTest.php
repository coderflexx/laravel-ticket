<?php

use Coderflex\LaravelTicket\Models\Category;
use Coderflex\LaravelTicket\Models\Ticket;

it('can store a category', function () {
    $ticket = Ticket::factory()->create();

    $category = Category::factory()->create([
        'name' => 'Support',
        'slug' => 'supoort',
    ]);

    $tableName = config(
        'laravel_ticket.table_names.categories',
        'categories'
    );

    $this->assertDatabaseHas($tableName, [
        'name' => 'Support',
        'slug' => 'supoort',
    ]);

    $this->assertEquals($category->count(), 1);
});
