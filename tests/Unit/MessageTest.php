<?php

use Coderflex\LaravelTicket\Models\Message;
use Coderflex\LaravelTicket\Models\Ticket;

it('can store a message', function () {
    $ticket = Ticket::factory()->create([
        'title' => 'Laravel is cool!',
    ]);

    $message = Message::factory()
                ->create([
                    'laravel_ticket_id' => $ticket->id,
                    'comment' => 'Message from a ticket',
                ]);

    $tableName = config(
        'laravel_ticket.table_names.messages',
        'messages'
    );

    $this->assertDatabaseHas($tableName, [
        'laravel_ticket_id' => $ticket->id,
        'comment' => 'Message from a ticket',
    ]);

    $this->assertEquals($message->count(), 1);
    $this->assertEquals($message->ticket->title, 'Laravel is cool!');
});
