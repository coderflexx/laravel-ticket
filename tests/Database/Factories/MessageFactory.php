<?php

namespace Coderflex\LaravelTicket\Tests\Database\Factories;

use Coderflex\LaravelTicket\Models\Message;
use Coderflex\LaravelTicket\Models\Ticket;
use Coderflex\LaravelTicket\Tests\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    protected $model = Message::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'laravel_ticket_id' => Ticket::factory(),
            'comment' => $this->faker->paragraph(2),
        ];
    }
}
