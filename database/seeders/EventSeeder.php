<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\Badge;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $badges = Badge::all();
        
        // Get test users (non-admin users)
        $testUsers = User::where('is_admin', false)->get();

        $events = [
            // Past Events (for testing completed events & badges)
            [
                'title' => 'Taal Lake Beach Cleanup 2024',
                'description' => 'Join us in cleaning the beautiful shores of Taal Lake. Bring gloves and bags!',
                'event_date' => now()->subDays(30),
                'location' => 'Taal Lake Beach, Talisay',
                'max_volunteers' => 50,
                'badge_id' => $badges->where('name', 'Beach Cleanup Hero')->first()->id ?? 1,
                'is_past' => true,
            ],
            [
                'title' => 'Tree Planting at Tagaytay Ridge',
                'description' => 'Help us plant 100 trees along the Tagaytay ridge to prevent erosion.',
                'event_date' => now()->subDays(20),
                'location' => 'Tagaytay Ridge, Cavite',
                'max_volunteers' => 30,
                'badge_id' => $badges->where('name', 'Tree Planter')->first()->id ?? 2,
                'is_past' => true,
            ],
            [
                'title' => 'Wildlife Rescue Mission',
                'description' => 'Helped rescue and relocate wildlife affected by recent storms.',
                'event_date' => now()->subDays(15),
                'location' => 'Taal Volcano Protected Area',
                'max_volunteers' => 20,
                'badge_id' => $badges->where('name', 'Wildlife Protector')->first()->id ?? 4,
                'is_past' => true,
            ],
            [
                'title' => 'Community Garden Launch',
                'description' => 'Successfully launched a community garden for local residents.',
                'event_date' => now()->subDays(7),
                'location' => 'Barangay San Nicolas, Talisay',
                'max_volunteers' => 25,
                'badge_id' => $badges->where('name', 'Community Leader')->first()->id ?? 5,
                'is_past' => true,
            ],
            
            // Upcoming Events (for testing join functionality)
            [
                'title' => 'Lake Cleanup - Save Taal Lake',
                'description' => 'Massive community effort to clean and protect Taal Lake. All ages welcome!',
                'event_date' => now()->addDays(3),
                'location' => 'Taal Lake Main Shore',
                'max_volunteers' => 100,
                'badge_id' => $badges->where('name', 'Lake Guardian')->first()->id ?? 3,
                'is_past' => false,
            ],
            [
                'title' => 'Wildlife Conservation Workshop',
                'description' => 'Learn about local wildlife and help with habitat restoration.',
                'event_date' => now()->addDays(7),
                'location' => 'Taal Volcano Protected Area',
                'max_volunteers' => 25,
                'badge_id' => $badges->where('name', 'Wildlife Protector')->first()->id ?? 4,
                'is_past' => false,
            ],
            [
                'title' => 'Community Garden Setup',
                'description' => 'Help set up a community garden for local residents.',
                'event_date' => now()->addDays(14),
                'location' => 'Barangay San Nicolas, Talisay',
                'max_volunteers' => 20,
                'badge_id' => $badges->where('name', 'Community Leader')->first()->id ?? 5,
                'is_past' => false,
            ],
            [
                'title' => 'Coastal Cleanup Drive',
                'description' => 'Monthly coastal cleanup to keep our shores pristine.',
                'event_date' => now()->addDays(21),
                'location' => 'Taal Lake Coast',
                'max_volunteers' => 40,
                'badge_id' => $badges->where('name', 'Beach Cleanup Hero')->first()->id ?? 1,
                'is_past' => false,
            ],
            [
                'title' => 'Reforestation Project',
                'description' => 'Large-scale tree planting initiative around Taal Volcano.',
                'event_date' => now()->addMonth(),
                'location' => 'Taal Volcano Slopes',
                'max_volunteers' => 200,
                'badge_id' => $badges->where('name', 'Tree Planter')->first()->id ?? 2,
                'is_past' => false,
            ],
        ];

        foreach ($events as $eventData) {
            $isPast = $eventData['is_past'] ?? false;
            unset($eventData['is_past']);
            
            $event = Event::create($eventData);
            
            // Auto-join test users to past events and award badges
            if ($isPast && $testUsers->isNotEmpty()) {
                foreach ($testUsers as $user) {
                    // Join the event as completed
                    $user->events()->attach($event->id, [
                        'status' => 'completed',
                        'created_at' => $event->event_date->subHours(2), // Joined 2 hours before event
                        'updated_at' => $event->event_date->addHours(3), // Updated after event ended
                    ]);
                    
                    // Award the badge
                    if ($event->badge_id) {
                        DB::table('user_badges')->insert([
                            'user_id' => $user->id,
                            'badge_id' => $event->badge_id,
                            'event_id' => $event->id,
                            'earned_at' => $event->event_date->addHours(3), // Earned after event
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
        }
    }
}