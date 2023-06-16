<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $image_url = [
            'home-3429674__340.jpg',
            'interior-3001598__340.jpg',
            'interior-3778708__340.jpg',
            'living-room-1835923__340.jpg',
            'living-room-2155353__340.jpg',
            'living-room-2155376__340.jpg',
            'living-room-modern-tv-4813589__340.jpg',
            'room-416050__340.jpg',
            'san-francisco-210230__340.jpg',
            'wall-416060__340.jpg'
        ];

        return [
            'image_url' => $image_url[array_rand($image_url)]
        ];
    }
}
