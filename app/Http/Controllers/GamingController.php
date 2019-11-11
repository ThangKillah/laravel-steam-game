<?php

namespace App\Http\Controllers;
use MarcReichel\IGDBLaravel\Models\Game;
use MarcReichel\IGDBLaravel\Models\Platform;

class GamingController extends Controller
{
    public function test()
    {
        $game =  Game::cache(0)->offset(0)->limit(100000)->get();
        dd($game);
    }
}
