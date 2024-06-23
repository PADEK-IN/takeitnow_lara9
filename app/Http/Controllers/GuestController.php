<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index(): View
    {
        // $events = Event::orderByDesc('schedule')->take(6)->get();

        // return view('pages.guest.welcome', compact('events'));
        return view('pages.guest.welcome');
    }

    public function eventPage(): View
    {
        // $events = Event::orderByDesc('schedule')->get();

        // return view('pages.guest.events', compact('events'));
        return view('pages.guest.events');
    }
}
