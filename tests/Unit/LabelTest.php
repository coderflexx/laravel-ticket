<?php

use Coderflex\LaravelTicket\Models\Label;
use Coderflex\LaravelTicket\Models\Ticket;

it('can store a label', function () {
    $ticket = Ticket::factory()->create();

    $label = Label::factory()
                ->for(
                    $ticket,
                    'labelable'
                )
                ->create([
                    'name' => 'Support',
                    'slug' => 'supoort',
                ]);

    $this->assertDatabaseHas('ticket_labels', [
        'name' => 'Support',
        'slug' => 'supoort',
    ]);

    $this->assertEquals($label->count(), 1);
});
