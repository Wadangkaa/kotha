<?php

namespace App\Http\Controllers;

use App\Models\Kotha;
use App\Models\UserPreference;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    public function recommendateRoom($user_preferences)
    {
        $kothas = Kotha::with('additionalInfo', 'location' , 'images')->get();


        $similarity_score = [];

        foreach ($kothas as $kotha) {
            $score = $this->calculate_similarity($user_preferences, $kotha);
            $similarity_score[] = ['kotha' => $kotha, 'score' => $score];
        }

        usort($similarity_score, function ($a, $b) {
            return $b["score"] - $a["score"];
        });

        $similarity_score = array_splice($similarity_score, 0, 3);
        $recommended_rooms = array_column($similarity_score, "kotha");
        return $recommended_rooms;
    }


    private function calculate_similarity($user_preferences, $kotha): int
    {
        $similarity = 0;

        if ($user_preferences->district == $kotha->location->district) {
            $similarity += 3;
        }

        if (
            $user_preferences->min_price <=  $kotha->price &&
            $user_preferences->max_price >= $kotha->price
        ) {
            $similarity += 2;
        }

        if ($user_preferences->parking == $kotha?->additionalInfo?->parking) {
            $similarity += 1;
        }

        return $similarity;
    }
}
