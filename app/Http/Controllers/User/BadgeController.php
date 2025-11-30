<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class BadgeController extends Controller
{
    protected $middleware = ['auth'];

    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $badges = $user->badges()->with('users')->get();

        return view('user.badges.index', compact('badges'));
    }
}
