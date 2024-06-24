<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Event;
use App\Models\Review;
use Illuminate\View\View;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class IndexController extends Controller
{
    public function index(): View
    {
        $qtyUser = User::count();
        $qtyEvent = Event::count();
        $qtyReview = Review::count();
        // $qtyTransaction = Transaction::where('isValid', true)
        //                             ->join('events', 'transactions.id_event', '=', 'events.id')
        //                             ->selectRaw('sum(events.price * transactions.quantity) as total_value')
        //                             ->value('total_value');
        $qtyTransaction = Transaction::with("eventData")->where("isValid", true)->get()->sum(function ($transaction) {
            $price = $transaction->eventData->price;
            $quantity = $transaction->quantity;
            return $price*$quantity;
        });

        $qty = [
            'user' => $qtyUser,
            'event' => $qtyEvent,
            'review' => $qtyReview,
            'transaction' => $qtyTransaction,
        ];

        // Mengirim dataQty ke view
        return view('pages.admin.dashboard.index', compact('qty'));
    }
}
