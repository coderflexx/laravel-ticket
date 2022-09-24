<?php

namespace Coderflex\LaravelTicket\Database\Factories;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        $tableName = config('laravel_ticket.table_names.category_ticket', 'category_ticket');

        Schema::create($tableName['table'], function (Blueprint $table) use ($tableName) {
            collect($tableName['columns'])->each(function ($column, $key) use ($table) {
                $table->foreignId($column);
            });
        });
    }
};
