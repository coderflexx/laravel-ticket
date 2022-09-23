<?php

use Coderflex\LaravelTicket\Models\Category;
use Coderflex\LaravelTicket\Models\Ticket;

it('can store a category', function () {
    $ticket = Ticket::factory()->create();

    $category = Category::factory()
        ->for(
            $ticket,
            'categorizable'
        )
        ->create([
            'name' => 'Support',
            'slug' => 'supoort',
        ]);

    $this->assertDatabaseHas('ticket_categories', [
        'name' => 'Support',
        'slug' => 'supoort',
    ]);

    $this->assertEquals($category->count(), 1);
});
