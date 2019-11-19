<?php

namespace App\Http\Controllers;

use App\Traits\GameApi;

class GamingController extends Controller
{
    use GameApi;

    public function test()
    {
        $game = $this->getGame(1);
        dd($game);
    }
}
