<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kotha>
 */
class KothaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $no_of_users = User::count();
        $users = range(1, $no_of_users);
        return [
            'description' =>  fake()->paragraph(),
            'price' => random_int(10000,99999),
            'user_id' => $users[array_rand($users)]
        ];
    }
}
