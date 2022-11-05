<?php

namespace Coderflex\LaravelTicket\Models;

use Coderflex\LaravelTicket\Concerns;
use Coderflex\LaravelTicket\Scopes\TicketScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User;

/**
 * Coderflex\LaravelTicket\Models\Ticket
 *
 * @property string $uuid
 * @property int $user_id
 * @property string $title
 * @property string $message
 * @property string $priority
 * @property string $status
 * @property bool $is_resolved
 * @property bool $is_locked
 * @property int $assigned_to
 */
class Ticket extends Model
{
    use HasFactory;
    use TicketScope;
    use Concerns\InteractsWithTickets;
    use Concerns\InteractsWithTicketRelations;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<string>|bool
     */
    protected $guarded = [];

    /**
     * Get User RelationShip
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get Assigned To User RelationShip
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function assignedToUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Get Messages RelationShip
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages(): HasMany
    {
        $tableName = config('laravel_ticket.table_names.messages', 'messages');

        return $this->hasMany(
            Message::class,
            (string) $tableName['columns']['ticket_foreing_id'],
        );
    }

    /**
     * Get Categories RelationShip
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        $table = config('laravel_ticket.table_names.category_ticket', 'category_ticket');

        return $this->belongsToMany(
            Category::class,
            $table['table'],
            $table['columns']['ticket_foreign_id'],
            $table['columns']['category_foreign_id'],
        );
    }

    /**
     * Get Labels RelationShip
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function labels(): BelongsToMany
    {
        $table = config('laravel_ticket.table_names.label_ticket', 'label_ticket');

        return $this->belongsToMany(
            Label::class,
            $table['table'],
            $table['columns']['ticket_foreign_id'],
            $table['columns']['label_foreign_id'],
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
            'laravel_ticket.table_names.tickets',
            parent::getTable()
        );
    }
}
