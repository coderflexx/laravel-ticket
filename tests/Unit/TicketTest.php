<?php

use Coderflex\LaravelTicket\Models\Ticket;

it('can store a ticket', function () {
    $ticket = Ticket::factory()->create([
        'title' => 'IT Support',
        'message' => 'Another Issue as always',
    ]);

    $tableName = config(
        'laravel_ticket.table_names.tickets',
        'tickets'
    );

    $this->assertDatabaseHas($tableName, [
        'title' => 'IT Support',
        'message' => 'Another Issue as always',
    ]);

    $this->assertEquals($ticket->count(), 1);
});
