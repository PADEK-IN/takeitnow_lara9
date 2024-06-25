<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\View\View;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index(): View
    {
        $events = Event::orderByDesc('schedule')->take(6)->get();

        return view('pages.guest.welcome', ['events'=>$events]);
    }

    public function eventPage(): View
    {
        $events = Event::orderByDesc('schedule')->get();

        return view('pages.guest.events', ['events'=>$events]);
    }
}
