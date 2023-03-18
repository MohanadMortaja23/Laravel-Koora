<?php

namespace Database\Factories;

use App\Models\LocalTeam;
use Illuminate\Database\Eloquent\Factories\Factory;
use Locale;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Conversation>
 */
class ConversationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        // $locals =LocalTeam::pluck('id')->toArray();
        return [
            // 'name'=> $this->faker->word(),
            // 'team_id'=> 1 ,
            // 'team_type'=> LocalTeam::class ,
        ];
    }
}
