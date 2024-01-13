<?php

namespace Database\Factories;

use App\Models\Request;

use App\Models\Sender;
use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Request>
 */
class RequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Request::class;
    public function definition(): array
    {
        return [

            'title' => $this->faker->title(),
            'description' => $this->faker->sentence(),
            'received_at' => $this->faker->date(),
            'sender_id'=> Sender::all()->random()->id,
            'state_id'=> State::all()->random()->id,


        ];
    }
}
