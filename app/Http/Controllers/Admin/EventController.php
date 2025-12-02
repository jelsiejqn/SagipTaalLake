<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Badge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    protected $middleware = ['auth'];

    public function index()
    {
        $events = Event::with('badge')->orderBy('event_date', 'desc')->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        $badges = Badge::all();
        return view('admin.events.create', compact('badges'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'max_volunteers' => 'nullable|integer|min:1',
            'badge_id' => 'nullable|exists:badges,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('events', 'public');
            $validated['image'] = $path;
        }

        Event::create($validated);

        return redirect()->route('admin.events.index')->with('success', 'Event created successfully!');
    }

    public function show(Event $event)
    {
        $volunteers = $event->users()->withPivot('status')->get();
        return view('admin.events.show', compact('event', 'volunteers'));
    }

    public function edit(Event $event)
    {
        $badges = Badge::all();
        return view('admin.events.edit', compact('event', 'badges'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'max_volunteers' => 'nullable|integer|min:1',
            'badge_id' => 'nullable|exists:badges,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle new image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($event->image && Storage::disk('public')->exists($event->image)) {
                Storage::disk('public')->delete($event->image);
            }
            
            $path = $request->file('image')->store('events', 'public');
            $validated['image'] = $path;
        }

        $event->update($validated);

        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully!');
    }

    public function destroy(Event $event)
    {
        // Delete associated image if exists
        if ($event->image && Storage::disk('public')->exists($event->image)) {
            Storage::disk('public')->delete($event->image);
        }
        
        $event->delete();
        
        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully!');
    }
}