<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Map>
 */
class MapFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'longitude' => fake()->longitude(85.2801323640076, 85.3566933381287),
            'latitude' => fake()->latitude(27.652982318975255, 27.7469108639932)
        ];
    }
}
