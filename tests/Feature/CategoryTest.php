<?php

use Coderflex\LaravelTicket\Models\Category;
use Coderflex\LaravelTicket\Models\Ticket;

it('can attach category to a ticket', function () {
    $category = Category::factory()->create();
    $ticket = Ticket::factory()->create();

    $category->tickets()->attach($ticket);

    $this->assertEquals($category->tickets->count(), 1);
});

it('can deattach category to a ticket', function () {
    $category = Category::factory()->create();
    $ticket = Ticket::factory()->create();

    $ticket->attachCategories($category);

    $category->tickets()->detach($ticket);

    $this->assertEquals($category->tickets->count(), 0);
});

it('gets categories by visibility status', function () {
    Category::factory()->times(10)->create([
        'is_visible' => true,
    ]);

    Category::factory()->times(9)->create([
        'is_visible' => false,
    ]);

    $this->assertEquals(Category::count(), 19);
    $this->assertEquals(Category::visible()->count(), 10);
    $this->assertEquals(Category::hidden()->count(), 9);
});
