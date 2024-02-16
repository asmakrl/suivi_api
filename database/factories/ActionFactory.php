<?php

namespace Database\Factories;

use App\Models\Request;
use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Action>
 */
class ActionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'action_time' => $this->faker->date(),
            'request_id' => Request::all()->random()->id,
            'type_id'=> Type::all()->random()->id,

        ];
    }
}
