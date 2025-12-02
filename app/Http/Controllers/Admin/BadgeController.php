<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Badge; // We only need the Badge model here
use Illuminate\Http\Request;

class BadgeController extends Controller
{
    /**
     * Display a listing of the resource (Badges).
     * This method handles the admin.badges.index route.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch all badges, perhaps with pagination for performance
        $badges = Badge::orderBy('id', 'desc')->paginate(10); 

        // Return the correct view for the badges index page
        return view('admin.badges.index', compact('badges')); 
    }
    
    /**
     * Show the form for creating a new badge.
     */
    public function create()
    {
        return view('admin.badges.create');
    }

    /**
     * Store a newly created badge in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:badges',
            'description' => 'required|string',
            'icon_url' => 'nullable|url',
        ]);

        Badge::create($validated);

        return redirect()->route('admin.badges.index')->with('success', 'Badge created successfully.');
    }

    // Since you used Route::resource, you should also include the 'edit' and 'update' methods

    /**
     * Show the form for editing the specified badge.
     */
    public function edit(Badge $badge)
    {
        return view('admin.badges.edit', compact('badge'));
    }

    /**
     * Update the specified badge in storage.
     */
    public function update(Request $request, Badge $badge)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:badges,name,' . $badge->id,
            'description' => 'required|string',
            'icon_url' => 'nullable|url',
        ]);

        $badge->update($validated);

        return redirect()->route('admin.badges.index')->with('success', 'Badge updated successfully.');
    }

    /**
     * Remove the specified badge from storage.
     */
    public function destroy(Badge $badge)
    {
        $badge->delete();

        return redirect()->route('admin.badges.index')->with('success', 'Badge deleted successfully.');
    }
}