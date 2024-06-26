<?php

namespace App\Http\Controllers\user;

use App\Models\Event;
use Illuminate\View\View;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserTransactionController extends Controller
{
    public function getAllData(): View
    {
        $idUser = Auth::id();
        $transactions = Transaction::join('events', 'events.id', '=', 'transactions.id_event')
                                    ->where('transactions.id_user', $idUser)
                                    ->select('transactions.*')
                                    ->orderByDesc('created_at')
                                    ->get();

        return view('pages.user.transactions.list', ['transactions' => $transactions]);
    }

    public function createPage($id)
    {
        $idUser = Auth::id();
        $idEvent = Hashids::decode($id);

        $event = Event::find($idEvent[0]);

        $transaction = Transaction::where('id_event', $idEvent)
                        ->select(DB::raw('SUM(quantity) as total_quantity'))
                        ->first();

        $totalQuantity = $transaction->total_quantity ?? 0;

        if($totalQuantity >= $event->quota) {
            return redirect()->back()
                            ->with('error', 'Maaf kuota tiket sudah penuh.')
                            ->withInput();
        }

        $isBuy = Transaction::where('id_user', $idUser)
                ->where('id_event', $idEvent[0])
                ->exists();

        if ($isBuy) {
            return redirect()->back()
                            ->with('error', 'Maaf, kamu sudah membeli tiket untuk acara ini.')
                            ->withInput();
        }

        return view('pages.user.transactions.create', compact('event', 'totalQuantity'));
    }

    public function createTransaction(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|integer',
            'proof' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // max 2MB
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }
        if ($request->input('quantity') <= 0) {
            return redirect()->back()
                            ->withErrors(['error' => 'Maaf, jumlah tiket tidak boleh 0.']);
        }

        // Handle image upload
        if ($request->hasFile('proof')) {
            $image = $request->file('proof');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('/uploads', $imageName, 'public_custom');
        } else {
            return redirect()->back()
                            ->withErrors(['error' => 'Maaf, tolong upload bukti pembayaran yang sah dengan jelas.']);
        }

        try {
            $idUser = Auth::id();
            $idEvent=Hashids::decode($request->input('id_event'));
            $event = Event::find($idEvent[0]);
            $transaction = Transaction::where('id_event', $idEvent[0])
                        ->select(DB::raw('SUM(quantity) as total_quantity'))
                        ->first();

            $totalQuantity = $transaction->total_quantity ?? 0;

            if($totalQuantity >= $event->quota) {
            return redirect()->back()
                            ->with('error', 'Maaf kuota tiket sudah penuh. Tiket yang tersisa adalah ' . ($event->quota - $totalQuantity) . ' tiket.')
                            ->withInput();
            }

            Transaction::create([
                'id_user' => $idUser,
                'id_event' => $idEvent[0],
                'quantity' => $request->input('quantity'),
                'proof' => $imageName,
            ]);

        } catch (\Exception $e) {
            return redirect()->back()
                            ->with('error', 'Server error, gagal melakukan pemesanan. Harap coba lagi.')
                            ->withInput();
        }

        return redirect()->route('event')->with('success', 'Berhasil melakukan pemesanan. Harap tunggu validasi maksimal 1x24 jam ya.');
    }

}
