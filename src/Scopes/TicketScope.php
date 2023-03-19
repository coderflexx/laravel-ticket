<?php

namespace Coderflex\LaravelTicket\Scopes;

use Coderflex\LaravelTicket\Enums\Priority;
use Coderflex\LaravelTicket\Enums\Status;
use Illuminate\Database\Eloquent\Builder;

trait TicketScope
{
    /**
     * Get closed tickets
     */
    public function scopeClosed(Builder $builder): Builder
    {
        return $builder->where('status', Status::CLOSED->value);
    }

    /**
     * Get opened tickets
     */
    public function scopeOpened(Builder $builder): Builder
    {
        return $builder->where('status', Status::OPEN->value);
    }

    /**
     * Get resolved tickets
     */
    public function scopeResolved(Builder $builder): Builder
    {
        return $builder->where('is_resolved', true);
    }

    /**
     * Get unresolved tickets
     */
    public function scopeUnresolved(Builder $builder): Builder
    {
        return $builder->where('is_resolved', false);
    }

    /**
     * Get locked tickets
     */
    public function scopeLocked(Builder $builder): Builder
    {
        return $builder->where('is_locked', true);
    }

    /**
     * Get unlocked tickets
     */
    public function scopeUnlocked(Builder $builder): Builder
    {
        return $builder->where('is_locked', false);
    }

    /**
     * Get custom priority tickets
     */
    public function scopeWithPriority(Builder $builder, string $priority): Builder
    {
        return $builder->where('priority', $priority);
    }

    /**
     * Get low priority tickets
     */
    public function scopeWithLowPriority(Builder $builder): Builder
    {
        return $builder->where('priority', Priority::LOW->value);
    }

    /**
     * Get normal priority tickets
     */
    public function scopeWithNormalPriority(Builder $builder): Builder
    {
        return $builder->where('priority', Priority::NORMAL->value);
    }

    /**
     * Get high priority tickets
     */
    public function scopeWithHighPriority(Builder $builder): Builder
    {
        return $builder->where('priority', Priority::HIGH->value);
    }

    /**
     * Get archived tickets
     */
    public function scopeArchived(Builder $builder): Builder
    {
        return $builder->where('status', Status::ARCHIVED->value);
    }

    /**
     * Get unarchived tickets
     */
    public function scopeUnArchived(Builder $builder): Builder
    {
        return $builder->whereNot('status', Status::ARCHIVED->value);
    }
}
