<?php

use App\Models\Event;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\GuestController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Guest Routes
Route::get('/', function(){
    $events = Event::orderByDesc('schedule')->take(6)->get();

    return view('pages.guest.welcome', ['events'=>$events]);
})->name('guest');

Route::get('/events', function(){
    $events = Event::orderByDesc('schedule')->get();

    return view('pages.guest.events', ['events'=>$events]);
})->name('guest.events');

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/user.php';

