<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\UserBadge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Event[] $events
 * @method \Illuminate\Database\Eloquent\Relations\BelongsToMany events()
 */

class EventController extends Controller
{
    public function index()
    {
        $upcomingEvents = Event::with('badge')
            ->where('event_date', '>=', now())
            ->orderBy('event_date', 'asc')
            ->get();

        $userEventIds = [];
        if (Auth::check()) {
            /** @var \App\Models\User $user */
            $user = Auth::user();
            $userEventIds = $user->events()->pluck('event_id')->toArray();
        }

        return view('user.events.index', compact('upcomingEvents', 'userEventIds'));
    }

    public function show(Event $event)
    {
        $event->load('badge', 'activeUsers');
        
        $isJoined = false;
        $isCancelled = false;
        $volunteersCount = $event->activeUsers()->count(); // Count both joined and completed

        if (Auth::check()) {
            /** @var \App\Models\User $user */
            $user = Auth::user();
            
            // Check if user has any registration for this event
            $userEvent = $user->events()->where('event_id', $event->id)->first();
            
            if ($userEvent) {
                $status = $userEvent->pivot->status;
                $isJoined = in_array($status, ['joined', 'completed']);
                $isCancelled = ($status === 'cancelled');
            }
        }

        return view('user.events.show', compact('event', 'isJoined', 'isCancelled', 'volunteersCount'));
    }

    public function join(Event $event)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Check if user already has a record for this event
        $existingRegistration = $user->events()->where('event_id', $event->id)->first();

        if ($existingRegistration) {
            $status = $existingRegistration->pivot->status;
            
            // If cancelled, allow re-joining by updating status
            if ($status === 'cancelled') {
                $user->events()->updateExistingPivot($event->id, ['status' => 'joined']);
                return redirect()->route('user.events.show', $event)
                    ->with('success', 'Successfully re-joined the event!');
            }
            
            // If already joined or completed
            return redirect()->route('user.events.show', $event)
                ->with('error', 'You have already joined this event.');
        }

        if ($event->max_volunteers && $event->activeUsers()->count() >= $event->max_volunteers) {
            return redirect()->route('user.events.show', $event)
                ->with('error', 'This event has reached maximum capacity.');
        }

        $user->events()->attach($event->id, ['status' => 'joined']);

        return redirect()->route('user.events.show', $event)
            ->with('success', 'Successfully joined the event!');
    }

    public function cancel(Event $event)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $pivot = $user->events()->where('event_id', $event->id)->first();

        if (!$pivot) {
            return redirect()->route('user.events.show', $event)
                ->with('error', 'You are not registered for this event.');
        }

        // Check if already cancelled
        if ($pivot->pivot->status === 'cancelled') {
            return redirect()->route('user.events.show', $event)
                ->with('info', 'You have already cancelled this event.');
        }

        $user->events()->updateExistingPivot($event->id, ['status' => 'cancelled']);

        return redirect()->route('user.events.show', $event)
            ->with('success', 'Event registration cancelled successfully.');
    }

    public function myEvents()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Auto-update past events to completed (runs when user visits this page)
        $pastEventIds = \DB::table('events')
            ->where('event_date', '<', now())
            ->pluck('id');
        
        if ($pastEventIds->isNotEmpty()) {
            \DB::table('event_user')
                ->where('status', 'joined')
                ->whereIn('event_id', $pastEventIds)
                ->update(['status' => 'completed']);
        }

        // Joined events that are upcoming (future dates, status = joined)
        $joinedEvents = $user->events()
            ->wherePivot('status', 'joined')
            ->where('event_date', '>=', now())
            ->orderBy('event_date', 'asc')
            ->get();

        // Past events that user joined (past dates, status = joined or completed)
        // These are events the user attended
        $pastEvents = $user->events()
            ->with('badge') // Load badge relationship
            ->whereIn('event_user.status', ['joined', 'completed'])
            ->where('event_date', '<', now())
            ->orderBy('event_date', 'desc')
            ->get();

        // TEMPORARY DEBUG - Remove after checking
        \Log::info('Past Events Count: ' . $pastEvents->count());
        foreach($pastEvents as $event) {
            \Log::info('Event: ' . $event->title . ' - Badge: ' . ($event->badge ? $event->badge->name : 'None'));
        }

        // Cancelled events (any date, status = cancelled)
        $cancelledEvents = $user->events()
            ->wherePivot('status', 'cancelled')
            ->orderBy('event_date', 'desc')
            ->get();

        return view('user.events.my-events', compact('joinedEvents', 'pastEvents', 'cancelledEvents'));
    }
}