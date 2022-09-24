<?php

namespace Coderflex\LaravelTicket\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Label extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<string>|bool
     */
    protected $guarded = [];

    /**
     * Get Labelable relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function labelable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get Tickets RelationShip
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tickets(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }

    /**
     * Get the table associated with the model.
     *
     * @return string
     */
    public function getTable()
    {
        return config(
            'laravel_ticket.table_names.labels',
            parent::getTable()
        );
    }
}
