<?php

use Coderflex\LaravelTicket\Models\Message;
use Coderflex\LaravelTicket\Models\Ticket;

it('can store a message', function () {
    $ticket = Ticket::factory()->create([
        'title' => 'Laravel is cool!',
    ]);

    $tableName = config(
        'laravel_ticket.table_names.messages',
        'messages'
    );

    $message = Message::factory()
                ->create([
                    $tableName['columns']['ticket_foreing_id'] => $ticket->id,
                    'message' => 'Message from a ticket',
                ]);

    $this->assertDatabaseHas($tableName['table'], [
        $tableName['columns']['ticket_foreing_id'] => $ticket->id,
        'message' => 'Message from a ticket',
    ]);

    $this->assertEquals($message->count(), 1);
    $this->assertEquals($message->ticket->title, 'Laravel is cool!');
});
