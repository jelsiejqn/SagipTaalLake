<?php
// app/Http/Controllers/Admin/DashboardController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use App\Models\Badge;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        // Get recent FAQs if table exists
        $recentFaqs = collect(); // Initialize as empty collection
        try {
            if (DB::getSchemaBuilder()->hasTable('faqs')) {
                $recentFaqs = Faq::ordered()->take(5)->get();
            }
        } catch (\Exception $e) {
            // FAQs table doesn't exist yet, that's okay
        }

        return view('admin.dashboard', compact(
            'totalEvents',
            'upcomingEvents',
            'totalVolunteers',
            'totalBadges',
            'recentEvents',
            'recentFaqs'
        ));
    }
}