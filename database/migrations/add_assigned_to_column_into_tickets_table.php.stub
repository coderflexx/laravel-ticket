<?php

namespace Coderflex\LaravelTicket\Database\Factories;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        $tableName = config('laravel_ticket.table_names.tickets', 'tickets');

        Schema::table($tableName, function (Blueprint $table) {
            $table->unsignedBigInteger('assigned_to')->nullable()->references('id')->on('users')->after('is_locked');
        });
    }
};
