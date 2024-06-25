<?php

namespace App\Http\Controllers\user;

use App\Models\Event;
use App\Models\Review;
use App\Models\Transaction;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class UserEventController extends Controller
{
    public function getAllData(): View
    {
        $events = Event::leftJoin('transactions', function($join) {
            $join->on('events.id', '=', 'transactions.id_event')
                    ->where('transactions.isValid', true);
        })
        ->select('events.*', DB::raw('SUM(transactions.quantity) as total_quantity'))
        ->groupBy('events.id')
        ->orderBy('events.schedule', 'desc')
        ->get();

        return view('pages.user.events.list', compact('events'));
    }

    public function getCreatePage(): View
    {
        return view('pages.user.events.create');
    }

    public function detail($id): View
    {
        $validId = Hashids::decode($id);

        $event = Event::find($validId[0]);

        // Check if the event exists
        if (!$event) {
            return redirect()->route('event')->with('error', 'Acara tidak ditemukan.');
        }

        $totalTransaction = Transaction::where('id_event', $validId[0])->count();

        // Return a view with the event data
        return view('pages.user.events.detail', compact('event', 'totalTransaction'));
    }

    public function reviewPage($id)
    {
        $idUser = Auth::id();
        $idEvent = Hashids::decode($id);

        $review = Review::where('id_user', $idUser)
                        ->where('id_event', $idEvent)
                        ->first();

        if ($review) {
            return redirect()->back()
                            ->withErrors(['error' => 'Maaf, kamu sudah memberi ulasan pada acara ini.']);
        };

        $event = Event::find($idEvent[0]);

        return view('pages.user.events.review', compact('event', 'review'));
    }

    public function createReview(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'rating' => 'required|integer',
            'comment' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }

        try {
            $idUser = Auth::id();
            $idEvent=Hashids::decode($request->input('id_event'));

            $existingReview = Review::where('id_user', $idUser)
                                    ->where('id_event', $idEvent)
                                    ->first();

            if ($existingReview) {
                return redirect()->back()
                                ->with('error', 'Maaf kamu sudah memberikan ulasan pada acara ini.')
                                ->withInput();
            }

            Review::create([
                'id_user' => $idUser,
                'id_event' => $idEvent[0],
                'rating' => $request->input('rating'),
                'comment' => $request->input('comment'),
            ]);

        } catch (\Exception $e) {
            return redirect()->back()
                            ->with('error', 'Server error, gagal menambahkan ulasan. Harap coba lagi.')
                            ->withInput();
        }

        return redirect()->route('transaction')->with('success', 'Berhasil memberikan ulasan.');
    }

}
