<?php

namespace Coderflex\LaravelTicket\Contracts;

use Illuminate\Database\Eloquent\Relations\HasMany;

interface CanUseTickets
{
    public function tickets(): HasMany;
}
