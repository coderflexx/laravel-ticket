<?php

namespace Coderflex\LaravelTicket\Concerns;

use Coderflex\LaravelTicket\Enums\Visibility;
use Illuminate\Database\Eloquent\Builder;

trait HasVisibility
{
    /**
     * Determine wheather if the model is visible
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVisible(Builder $builder)
    {
        return $builder->where('is_visible', Visibility::VISIBLE->value);
    }

    /**
     * Determine wheather if the model is hidden
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeHidden(Builder $builder)
    {
        return $builder->where('is_visible', Visibility::HIDDEN->value);
    }
}