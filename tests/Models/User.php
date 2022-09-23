<?php

namespace Coderflex\LaravelTicket\Tests\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends \Illuminate\Foundation\Auth\User
{
    use HasFactory;

    protected $guarded = [];
}
