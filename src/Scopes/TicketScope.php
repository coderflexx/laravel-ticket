<?php

namespace Coderflex\LaravelTicket\Scopes;

use Coderflex\LaravelTicket\Enums\Priority;
use Coderflex\LaravelTicket\Enums\Status;
use Illuminate\Database\Eloquent\Builder;

trait TicketScope
{
    /**
     * Get closed tickets
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeClosed(Builder $builder): Builder
    {
        return $builder->where('status', Status::CLOSED->value);
    }

    /**
     * Get opened tickets
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOpened(Builder $builder): Builder
    {
        return $builder->where('status', Status::OPEN->value);
    }

    /**
     * Get resolved tickets
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeResolved(Builder $builder): Builder
    {
        return $builder->where('is_resolved', true);
    }

    /**
     * Get unresolved tickets
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUnresolved(Builder $builder): Builder
    {
        return $builder->where('is_resolved', false);
    }

    /**
     * Get locked tickets
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLocked(Builder $builder): Builder
    {
        return $builder->where('is_locked', true);
    }

    /**
     * Get unlocked tickets
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUnlocked(Builder $builder): Builder
    {
        return $builder->where('is_locked', false);
    }

    /**
     * Get custom priority tickets
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithPriority(Builder $builder, string $priority): Builder
    {
        return $builder->where('priority', $priority);
    }

    /**
     * Get low priority tickets
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithLowPriority(Builder $builder): Builder
    {
        return $builder->where('priority', Priority::LOW->value);
    }

    /**
     * Get normal priority tickets
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithNormalPriority(Builder $builder): Builder
    {
        return $builder->where('priority', Priority::NORMAL->value);
    }

    /**
     * Get high priority tickets
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithHighPriority(Builder $builder): Builder
    {
        return $builder->where('priority', Priority::HIGH->value);
    }
}
