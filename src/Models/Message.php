<?php

namespace Coderflex\LaravelTicket\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Coderflex\LaravelTicket\Models\Message
 *
 * @property int $user_id
 * @property string $message
 */
class Message extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<string>|bool
     */
    protected $guarded = [];

    /**
     * Get Ticket RelationShip
     */
    public function ticket(): BelongsTo
    {
        $tableName = config('laravel_ticket.table_names.messages', 'messages');

        return $this->belongsTo(
            config('laravel_ticket.models.ticket'),
            $tableName['columns']['ticket_foreign_id']
        );
    }

    /**
     * Get Message Relationship
     */
    public function user(): BelongsTo
    {
        $tableName = config('laravel_ticket.table_names.messages', 'message');

        return $this->belongsTo(
            config('auth.providers.users.model'),
            $tableName['columns']['user_foreign_id']
        );
    }

    /**
     * Get the table associated with the model.
     *
     * @return string
     */
    public function getTable()
    {
        return config(
            'laravel_ticket.table_names.messages.table',
            parent::getTable()
        );
    }
}
