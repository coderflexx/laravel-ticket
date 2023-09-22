<?php

namespace Coderflex\LaravelTicket\Concerns;

use Coderflex\LaravelTicket\Models\Message;
use Coderflex\LaravelTicket\Models\Ticket;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasTickets
{
    /**
     * Get User tickets relationship
     */
    public function tickets(): HasMany
    {
        return $this->hasMany(config('laravel_ticket.models.ticket', Ticket::class), 'user_id');
    }

    /**
     * Get User tickets relationship
     */
    public function messages(): HasMany
    {
        return $this->hasMany(config('laravel_ticket.models.message', Message::class), 'user_id');
    }
}
