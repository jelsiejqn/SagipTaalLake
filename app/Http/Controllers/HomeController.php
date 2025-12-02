<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // Check if FAQs table exists
        $faqs = [];
        try {
            if (DB::getSchemaBuilder()->hasTable('faqs')) {
                $faqs = DB::table('faqs')
                    ->where('is_active', true)
                    ->orderBy('display_order', 'asc')
                    ->get();
            }
        } catch (\Exception $e) {
            // FAQs table doesn't exist yet, that's okay
        }

        return view('home', compact('faqs'));
    }

    public function account()
    {
        return view('user.account');
    }
}
