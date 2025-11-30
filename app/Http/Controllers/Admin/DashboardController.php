<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use App\Models\Badge;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $middleware = ['auth'];

    public function index()
    {
        $totalEvents = Event::count();
        $upcomingEvents = Event::where('event_date', '>=', now())->count();
        $totalVolunteers = User::where('is_admin', false)->count();
        $totalBadges = Badge::count();

        $recentEvents = Event::orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact(
            'totalEvents',
            'upcomingEvents',
            'totalVolunteers',
            'totalBadges',
            'recentEvents'
        ));
    }
}
