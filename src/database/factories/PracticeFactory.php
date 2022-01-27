<?php

namespace Database\Factories;

use App\Models\Domain;
use App\Models\PublicationState;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class PracticeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(40),
            'description' => $this->faker->realText(1000),
            'domain_id' => Domain::all()->random()->id,
            'publication_state_id' => PublicationState::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'updated_at' => Carbon::now()->subMinutes(rand(1, 5*24*60))
        ];
    }
}
