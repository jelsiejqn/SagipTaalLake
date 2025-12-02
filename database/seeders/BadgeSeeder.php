<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Badge;

class BadgeSeeder extends Seeder
{
    public function run(): void
    {
        $badges = [
            [
                'name' => 'Beach Cleanup Hero',
                'description' => 'Completed a beach cleanup event',
                'icon' => '🏖️',
            ],
            [
                'name' => 'Tree Planter',
                'description' => 'Planted trees for a greener future',
                'icon' => '🌳',
            ],
            [
                'name' => 'Lake Guardian',
                'description' => 'Protected Taal Lake environment',
                'icon' => '💧',
            ],
            [
                'name' => 'Wildlife Protector',
                'description' => 'Helped protect local wildlife',
                'icon' => '🦅',
            ],
            [
                'name' => 'Community Leader',
                'description' => 'Led a community volunteer event',
                'icon' => '⭐',
            ],
        ];

        foreach ($badges as $badge) {
            Badge::create($badge);
        }
    }
}