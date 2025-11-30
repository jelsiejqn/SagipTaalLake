<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Badge;
use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@sagiptaal.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        // Create regular user
        User::create([
            'name' => 'John Volunteer',
            'email' => 'volunteer@example.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
        ]);

        // Create badges
        $badge1 = Badge::create([
            'name' => 'Lake Guardian',
            'description' => 'Awarded for participating in lake cleanup',
            'icon' => '🌊',
        ]);

        $badge2 = Badge::create([
            'name' => 'Tree Planter',
            'description' => 'Awarded for planting trees',
            'icon' => '🌳',
        ]);

        $badge3 = Badge::create([
            'name' => 'Community Hero',
            'description' => 'Awarded for community outreach',
            'icon' => '⭐',
        ]);

        // Create events
        Event::create([
            'title' => 'Taal Lake Cleanup Drive',
            'description' => 'Join us in cleaning up the shores of Taal Lake. We will provide all necessary equipment. Bring your enthusiasm and let\'s make a difference together!',
            'event_date' => now()->addDays(7),
            'location' => 'Taal Lake, Batangas',
            'max_volunteers' => 50,
            'badge_id' => $badge1->id,
        ]);

        Event::create([
            'title' => 'Tree Planting Activity',
            'description' => 'Help us plant native trees around Taal Lake to restore the natural ecosystem and prevent soil erosion.',
            'event_date' => now()->addDays(14),
            'location' => 'Taal Volcano Island',
            'max_volunteers' => 30,
            'badge_id' => $badge2->id,
        ]);

        Event::create([
            'title' => 'Community Awareness Seminar',
            'description' => 'Educational seminar about the importance of preserving Taal Lake and its surrounding environment.',
            'event_date' => now()->addDays(21),
            'location' => 'Talisay Municipal Hall',
            'max_volunteers' => null,
            'badge_id' => $badge3->id,
        ]);
    }
}
