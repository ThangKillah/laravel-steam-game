<?php

namespace App\Traits;

use MarcReichel\IGDBLaravel\Models\Game;
use MarcReichel\IGDBLaravel\Models\Platform;

trait GameApi
{
    public function getGame($page = 1)
    {
        $limit = 100;
        $offset = ($page - 1) * $limit;

        $platforms = Platform::where('name', 'Mac')
            ->orWhere('name', 'Linux')
            ->orWhere('name', 'PC (Microsoft Windows)')
            ->orWhere('name', 'Nintendo Switch')
            ->orWhere('name', 'PlayStation 4')
            ->orWhere('name', 'Xbox One')
            ->orWhere('name', 'Xbox 360')
            ->orWhere('name', 'PlayStation 3')
            ->with(['platform_logo', 'websites'])
            ->get();

        $games = Game:: whereIn('platforms', $platforms->pluck('id')->toArray())
            //        whereHas('release_dates', function ($q) {
            //            $q->whereIn('platform.id', [48, 49, 6]);
            //        })
            ->whereDate('first_release_date', '>=', config('constant.date_api_init')) // condition
            ->where('category', 0)
            ->whereNotNull('pulse_count')
            ->orderBy('popularity', 'desc') // order by
            ->orderBy('pulse_count', 'desc')
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