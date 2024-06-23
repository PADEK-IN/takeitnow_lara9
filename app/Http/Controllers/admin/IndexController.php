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
        $qtyTransaction = Transaction::all()->sum(function ($transaction) {
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

        // $oneMonthAgo = Carbon::now()->subMonth();

        // $transactions = Transaction::where('created_at', '>=', $oneMonthAgo)
        //     ->with('eventData')
        //     ->get()
        //     ->groupBy(function($date) {
        //         return Carbon::parse($date->created_at)->format('Y-m-d'); // grouping by days
        //     });

        // $dates = [];
        // $data = [];

        // foreach ($transactions as $date => $transactionsByDate) {
        //     $dates[] = $date;
        //     $data[] = $transactionsByDate->count();
        // }

        // Mengirim dataQty ke view
        return view('pages.admin.dashboard.index', compact('qty'));
    }
}
