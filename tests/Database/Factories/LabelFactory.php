<?php

namespace Coderflex\LaravelTicket\Tests\Database\Factories;

use Coderflex\LaravelTicket\Models\Label;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LabelFactory extends Factory
{
    protected $model = Label::class;

    public function definition()
    {
        return [
            'name' => $name = $this->faker->name(),
            'slug' => Str::slug($name),
            'is_visible' => $this->faker->randomElement([true, false]),
        ];
    }
}
