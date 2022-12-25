<?php

use Coderflex\LaravelTicket\Models\Message;
use Coderflex\LaravelTicket\Models\Ticket;
use Coderflex\LaravelTicket\Tests\Models\User;

it('can attach message to a ticket', function () {
    $message = Message::factory()->create();
    $ticket = Ticket::factory()->create([
        'title' => 'Can you create a message?',
    ]);

    $message->ticket()->associate($ticket);

    $this->assertEquals($message->ticket->title, 'Can you create a message?');
});

it('message can be associated to a user', function () {
    $user = User::factory()->create([
        'name' => 'Oussama',
    ]);

    $message = Message::factory()->create();

    $message->user()->associate($user);

    $this->assertEquals($message->user->name, 'Oussama');
});
