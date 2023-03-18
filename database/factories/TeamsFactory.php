<?php

namespace Database\Factories;

use App\Models\LocalTeam;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TeamsFactory extends Factory
{

    protected $model = LocalTeam::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'status' => 1, 
            'image'=> fake()->imageUrl(),
        ];
    }
}
