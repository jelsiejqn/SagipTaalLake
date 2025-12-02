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
        // Create admin user (safe)
        $admin = User::firstOrCreate(
            ['email' => 'admin@sagiptaal.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'is_admin' => true,
            ]
        );

        // Create regular volunteer user (safe)
        $volunteer = User::firstOrCreate(
            ['email' => 'volunteer@example.com'],
            [
                'name' => 'John Volunteer',
                'password' => Hash::make('password'),
                'is_admin' => false,
            ]
        );

        // Create badges (safe)
        $badge1 = Badge::updateOrCreate(
            ['name' => 'Lake Guardian'],
            [
                'description' => 'Awarded for participating in lake cleanup',
                'icon' => '🌊',
            ]
        );

        $badge2 = Badge::updateOrCreate(
            ['name' => 'Tree Planter'],
            [
                'description' => 'Awarded for planting trees',
                'icon' => '🌳',
            ]
        );

        $badge3 = Badge::updateOrCreate(
            ['name' => 'Community Hero'],
            [
                'description' => 'Awarded for community outreach',
                'icon' => '⭐',
            ]
        );

        // Create events (safe)
        Event::updateOrCreate(
            ['title' => 'Taal Lake Cleanup Drive'],
            [
                'description' => 'Join us in cleaning up the shores of Taal Lake. We will provide all necessary equipment. Bring your enthusiasm and let\'s make a difference together!',
                'event_date' => now()->subDay(),
                'location' => 'Taal Lake, Batangas',
                'max_volunteers' => 50,
                'badge_id' => $badge1->id,
            ]
        );

        Event::updateOrCreate(
            ['title' => 'Tree Planting Activity'],
            [
                'description' => 'Help us plant native trees around Taal Lake to restore the natural ecosystem and prevent soil erosion.',
                'event_date' => now()->addDays(14),
                'location' => 'Taal Volcano Island',
                'max_volunteers' => 30,
                'badge_id' => $badge2->id,
            ]
        );

        Event::updateOrCreate(
            ['title' => 'Community Awareness Seminar'],
            [
                'description' => 'Educational seminar about the importance of preserving Taal Lake and its surrounding environment.',
                'event_date' => now()->addDays(21),
                'location' => 'Talisay Municipal Hall',
                'max_volunteers' => null,
                'badge_id' => $badge3->id,
            ]
        );
    }
}
