<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class UpdatePastEventsStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only run once per hour using cache to avoid excessive database queries
        if (!Cache::has('events_status_updated')) {
            try {
                // Get all events that have passed
                $pastEvents = DB::table('events')
                    ->where('event_date', '<', now())
                    ->get();
                
                if ($pastEvents->isNotEmpty()) {
                    $pastEventIds = $pastEvents->pluck('id');
                    
                    // Get all users who joined these past events
                    $completedRegistrations = DB::table('event_user')
                        ->where('status', 'joined')
                        ->whereIn('event_id', $pastEventIds)
                        ->get();
                    
                    // Update status to completed
                    DB::table('event_user')
                        ->where('status', 'joined')
                        ->whereIn('event_id', $pastEventIds)
                        ->update(['status' => 'completed']);
                    
                    // Award badges for completed events
                    foreach ($completedRegistrations as $registration) {
                        $event = $pastEvents->firstWhere('id', $registration->event_id);
                        
                        // Only award badge if event has one and user doesn't already have it for this event
                        if ($event && $event->badge_id) {
                            $existingBadge = DB::table('user_badges')
                                ->where('user_id', $registration->user_id)
                                ->where('badge_id', $event->badge_id)
                                ->where('event_id', $event->id)
                                ->exists();
                            
                            if (!$existingBadge) {
                                DB::table('user_badges')->insert([
                                    'user_id' => $registration->user_id,
                                    'badge_id' => $event->badge_id,
                                    'event_id' => $event->id,
                                    'earned_at' => now(),
                                    'created_at' => now(),
                                    'updated_at' => now(),
                                ]);
                            }
                        }
                    }
                }
                
                // Cache for 1 hour so it doesn't run on every request
                Cache::put('events_status_updated', true, now()->addHour());
            } catch (\Exception $e) {
                // Silently fail to not break the application
                // You can log the error if needed
                // \Log::error('Failed to update past events status: ' . $e->getMessage());
            }
        }

        return $next($request);
    }
}