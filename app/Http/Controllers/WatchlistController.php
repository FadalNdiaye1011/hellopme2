<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use Illuminate\Http\Request;
use App\Models\Watchlist;

class WatchlistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add(Opportunity $opportunity)
    {
        $user = auth()->user();

        if (!$user->watchlists->contains('opportunity_id', $opportunity->id)) {
            $user->watchlists()->create(['opportunity_id' => $opportunity->id]);
        }

        return redirect()->back()->with('success', 'Opportunity added to your watchlist.');
    }

    public function remove(Opportunity $opportunity)
    {
        $user = auth()->user();
        $user->watchlists()->where('opportunity_id', $opportunity->id)->delete();
        return redirect()->back()->with('success', 'Opportunity removed from your watchlist.');
    }
}
