<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Additional_info>
 */
class Additional_infoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'bedroom' => random_int(1, 4),
            'kitchen' => random_int(1, 2),
            'living_room' => 1,
            'parking' => rand(0,1),
            'toilet' => random_int(1, 2)
        ];
    }
}
