<?php

use Coderflex\LaravelTicket\Models\Comment;
use Coderflex\LaravelTicket\Models\Ticket;

it('can store a comment', function () {
    $ticket = Ticket::factory()->create([
        'title' => 'Laravel is cool!',
    ]);

    $comment = Comment::factory()
                ->create([
                    'laravel_ticket_id' => $ticket->id,
                    'comment' => 'Comment from a ticket',
                ]);

    $this->assertDatabaseHas('ticket_comments', [
        'laravel_ticket_id' => $ticket->id,
        'comment' => 'Comment from a ticket',
    ]);

    $this->assertEquals($comment->count(), 1);
    $this->assertEquals($comment->ticket->title, 'Laravel is cool!');
});
