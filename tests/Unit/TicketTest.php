<?php

use Coderflex\LaravelTicket\Models\Ticket;

it('can store a ticket', function () {
    $ticket = Ticket::factory()->create([
        'title' => 'IT Support',
        'message' => 'Another Issue as always',
    ]);

    $this->assertDatabaseHas('laravel_tickets', [
        'title' => 'IT Support',
        'message' => 'Another Issue as always',
    ]);

    $this->assertEquals($ticket->count(), 1);
});
