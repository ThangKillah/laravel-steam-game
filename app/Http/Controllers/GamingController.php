<?php

namespace App\Http\Controllers;
use MarcReichel\IGDBLaravel\Models\Game;

class GamingController extends Controller
{
    public function test()
    {
        $games = Game::
        whereHas('release_dates', function ($q) {
            $q->whereIn('platform', [48, 49, 6]);
        })
            ->with(['platforms', 'websites', 'genres'])
            ->offset(0)->limit(10)
            ->whereDate('first_release_date', '>=', '2018-01-01')
            ->where('category', 0)
            ->get();
        dd($games);
    }
}
