<?php

use Coderflex\LaravelTicket\Models\Label;
use Coderflex\LaravelTicket\Models\Ticket;
use Coderflex\LaravelTicket\Tests\Models\User;

it('creates a ticket with associated user', function () {
    $user = User::factory()->create();

    Ticket::factory()->create([
        'title' => 'IT Support',
        'user_id' => $user->id,
    ]);

    $this->assertEquals($user->tickets()->count(), 1);
    $this->assertEquals($user->tickets()->first()->title, 'IT Support');
});

it('associates labels to a ticket', function () {
    $labels = Label::factory()->times(3)->create();
    $ticket = Ticket::factory()->create();

    $ticket->attachLabels($labels->pluck('id'));

    $this->assertEquals($ticket->labels->count(), 3);
});

it('sync labels to a ticket', function () {
    $labels = Label::factory()->times(2)->create();
    $ticket = Ticket::factory()->create();

    $ticket->syncLabels($labels->pluck('id'));

    $this->assertEquals($ticket->labels->count(), 2);
});

it('sync labels to a ticket without detaching', function () {
    $labels = Label::factory()->times(3)->create();
    $ticket = Ticket::factory()->create();
    $ticket->attachLabels($labels->pluck('id'));

    $anotherlabels = Label::factory()->times(2)->create();

    $ticket->syncLabels($anotherlabels->pluck('id'), false);

    $this->assertEquals($ticket->labels->count(), 5);
});
