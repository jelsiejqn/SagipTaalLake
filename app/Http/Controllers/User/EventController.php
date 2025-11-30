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
    protected $middleware = ['auth'];

    public function index()
    {
        $upcomingEvents = Event::where('event_date', '>=', now())
            ->orderBy('event_date', 'asc')
            ->get();

        /** @var \App\Models\User $user */

        $user = Auth::user();
        $userEventIds = $user->events()->pluck('event_id')->toArray();

        return view('user.events.index', compact('upcomingEvents', 'userEventIds'));
    }

    public function show(Event $event)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();   // ← You forgot this

        $isJoined = $user->events()->where('event_id', $event->id)->exists();
        $volunteersCount = $event->joinedUsers()->count();

        return view('user.events.show', compact('event', 'isJoined', 'volunteersCount'));
    }


    public function join(Event $event)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->events()->where('event_id', $event->id)->exists()) {
            return back()->with('error', 'You have already joined this event.');
        }

        if ($event->max_volunteers && $event->joinedUsers()->count() >= $event->max_volunteers) {
            return back()->with('error', 'This event has reached maximum capacity.');
        }

        $user->events()->attach($event->id, ['status' => 'joined']);

        return back()->with('success', 'Successfully joined the event!');
    }

    public function cancel(Event $event)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $pivot = $user->events()->where('event_id', $event->id)->first();

        if (!$pivot) {
            return back()->with('error', 'You are not registered for this event.');
        }

        $user->events()->updateExistingPivot($event->id, ['status' => 'cancelled']);

        return back()->with('success', 'Event registration cancelled.');
    }

    public function myEvents()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $joinedEvents = $user->events()
            ->wherePivot('status', 'joined')
            ->where('event_date', '>=', now())
            ->orderBy('event_date', 'asc')
            ->get();

        $pastEvents = $user->events()
            ->wherePivot('status', 'completed')
            ->where('event_date', '<', now())
            ->orderBy('event_date', 'desc')
            ->get();

        $cancelledEvents = $user->events()
            ->wherePivot('status', 'cancelled')
            ->orderBy('event_date', 'desc')
            ->get();

        return view('user.events.my-events', compact('joinedEvents', 'pastEvents', 'cancelledEvents'));
    }
}
