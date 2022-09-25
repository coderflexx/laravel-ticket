<?php

use Coderflex\LaravelTicket\Models\Message;
use Coderflex\LaravelTicket\Models\Ticket;

it('can attach message to a ticket', function () {
    $message = Message::factory()->create();
    $ticket = Ticket::factory()->create([
        'title' => 'Can you create a message?',
    ]);

    $message->ticket()->associate($ticket);

    $this->assertEquals($message->ticket->title, 'Can you create a message?');
});
