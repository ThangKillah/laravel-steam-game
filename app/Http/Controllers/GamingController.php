<?php

namespace App\Http\Controllers;

use App\Traits\GameApi;
use App\Traits\GameSpotApi;

class GamingController extends Controller
{
    use GameApi, GameSpotApi;

    public function test()
    {
        $review = $this->getBlog(1);
        //$game = $this->getGame(1);
        dd($review);
    }
}
