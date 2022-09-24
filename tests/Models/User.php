<?php

namespace Coderflex\LaravelTicket\Tests\Models;

use Coderflex\LaravelTicket\Concerns\HasTickets;
use Coderflex\LaravelTicket\Contracts\CanUseTickets;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements CanUseTickets
{
    use HasFactory;
    use HasTickets;

    protected $guarded = [];
}
