<?php

namespace Coderflex\LaravelTicket\Concerns;

use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasTickets
{
    /**
     * Get User tickets relationship
     */
    public function tickets(): HasMany
    {
        $model = config(
            'laravel_ticket.models.ticket',
            parent::getTable()
        );
        return $this->hasMany($model, 'user_id');
    }

    /**
     * Get User tickets relationship
     */
    public function messages(): HasMany
    {
        $model = config(
            'laravel_ticket.models.message',
            parent::getTable()
        );
        return $this->hasMany($model, 'user_id');
    }
}
