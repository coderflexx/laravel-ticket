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

it('associates a ticket with labels', function () {
    // $labels = Label::factory()->times(3)->create();
});
