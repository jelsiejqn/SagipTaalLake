<?php
// app/Http/Controllers/HomeController.php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // Check if FAQs table exists and fetch active FAQs
        $faqs = [];
        try {
            if (DB::getSchemaBuilder()->hasTable('faqs')) {
                $faqs = Faq::active()->ordered()->get();
            }
        } catch (\Exception $e) {
            // FAQs table doesn't exist yet or model issue, that's okay
        }

        return view('home', compact('faqs'));
    }

    public function account()
    {
        return view('user.account');
    }
}