<?php

namespace App\Traits;

use MarcReichel\IGDBLaravel\Models\Game;

trait GameApi
{
    public function getGame($page = 1)
    {
        $limit = 100;
        $offset = ($page - 1) * $limit;

        //dd(Theme::all());

        $games = Game:: whereIn('platforms', [48, 49, 6])
            //        whereHas('release_dates', function ($q) {
            //            $q->whereIn('platform.id', [48, 49, 6]);
            //        })
            ->whereDate('first_release_date', '>=', '2017-01-01')
            ->where('category', 0)
            ->where('popularity', '>=', 5)
            ->orderBy('popularity', 'desc')
            ->with([
                'cover',
                'game_engines',
                'game_engines.logo',
                'keywords',
                'involved_companies',
                'involved_companies.company',
                'involved_companies.company.logo',
                'involved_companies.company.websites',
                'multiplayer_modes',
                'game_modes',
                'genres',
                'platforms',
                'release_dates',
                'screenshots',
                'similar_games',
                'themes',
                'videos',
                'websites',
            ])
            ->offset($offset)->limit($limit)
            ->get();

//        foreach ($games as $game)
//        {
//            dd($game);
//        }

        return $games;
    }
}