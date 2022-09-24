<?php

use Coderflex\LaravelTicket\Models\Ticket;

it('filters tickets by status', function () {
    Ticket::factory()
            ->times(3)
            ->create([
                'status' => 'open',
            ]);

    Ticket::factory()
            ->times(7)
            ->create([
                'status' => 'closed',
            ]);

    $this->assertEquals(Ticket::count(), 10);
    $this->assertEquals(Ticket::opened()->count(), 3);
    $this->assertEquals(Ticket::closed()->count(), 7);
});

it('filters tickets by resolved status', function () {
    Ticket::factory()
            ->times(2)
            ->create([
                'is_resolved' => true,
            ]);

    Ticket::factory()
            ->times(10)
            ->create([
                'is_resolved' => false,
            ]);

    $this->assertEquals(Ticket::count(), 12);
    $this->assertEquals(Ticket::resolved()->count(), 2);
    $this->assertEquals(Ticket::unresolved()->count(), 10);
});

it('filters tickets by locked status', function () {
    Ticket::factory()
            ->times(3)
            ->create([
                'is_locked' => true,
            ]);

    Ticket::factory()
            ->times(9)
            ->create([
                'is_locked' => false,
            ]);

    $this->assertEquals(Ticket::count(), 12);
    $this->assertEquals(Ticket::locked()->count(), 3);
    $this->assertEquals(Ticket::unlocked()->count(), 9);
});

it('filters tickets by priority status', function () {
    Ticket::factory()
            ->times(7)
            ->create([
                'priority' => 'low',
            ]);

    Ticket::factory()
            ->times(5)
            ->create([
                'priority' => 'normal',
            ]);

    Ticket::factory()
            ->times(15)
            ->create([
                'priority' => 'high',
            ]);

    $this->assertEquals(Ticket::count(), 27);
    $this->assertEquals(Ticket::withLowPriority()->count(), 7);
    $this->assertEquals(Ticket::withNormalPriority()->count(), 5);
    $this->assertEquals(Ticket::withHighPriority()->count(), 15);
});
