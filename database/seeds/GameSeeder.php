<?php

use App\Traits\GameApi;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use MarcReichel\IGDBLaravel\Models\CompanyWebsite;
use MarcReichel\IGDBLaravel\Models\GameEngine;
use MarcReichel\IGDBLaravel\Models\GameVideo;

class GameSeeder extends Seeder
{
    use GameApi;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ini_set('memory_limit', '1024M');

        $arrGames = [];
        $arrEngines = [];
        $idEngines = [];
        $arrEngineGames = [];

        $arrKeyword = [];
        $idsKey = [];
        $arrKeywordGame = [];

        $arrCompany = [];
        $idsCompany = [];
        $arrCompanyDevelop = [];

        $arrMultipleMode = [];

        $arrGameMode = [];
        $arrGameGenres = [];
        $arrGamePlatforms = [];
        $arrGameReleaseDate = [];
        $arrGameThemes = [];

        for ($i = 1; $i <= 1000; $i++) {
            $games = $this->getGame($i);
            if ($games->isEmpty()) {
                break;
            }

            foreach ($games as $game) {
                $screenshotsId = [];
                if (!empty($game->screenshots)) {
                    $screenshotsId = $game->screenshots->pluck('image_id');
                }

                $similarGameIds = [];
                if (!empty($game->similar_games)) {
                    $similarGameIds = $game->similar_games->pluck('id');
                }

                $arrVideos = [];
                if (!empty($game->videos)) {
                    foreach ($game->videos as $video) {
                        if ($video instanceof GameVideo) {
                            array_push($arrVideos, [
                                'id' => $video->id,
                                'name' => $video->name,
                                'video_id' => $video->video_id
                            ]);
                        }
                    }
                }

                $arrWebsites = [];
                if (!empty($game->websites)) {
                    foreach ($game->websites as $web) {
                        if (!empty($web->id)) {
                            array_push($arrWebsites, [
                                'id' => $web->id,
                                'category' => $web->category,
                                'url' => $web->url
                            ]);
                        }
                    }
                }

                $dataGame = [
                    'game_id' => $game->id,
                    'category_id' => $game->category,
                    'cover' => empty($game->cover) || empty($game->cover->image_id) ? null : $game->cover->image_id,
                    'screenshots' => json_encode($screenshotsId),
                    'videos' => json_encode($arrVideos),
                    'websites' => json_encode($arrWebsites),
                    'similar_games' => json_encode($similarGameIds),
                    'aggregated_rating' => $game->aggregated_rating,
                    'aggregated_rating_count' => $game->aggregated_rating_count,
                    'first_release_date' => $game->first_release_date,
                    'follows' => empty($game->follows) ? 0 : $game->follows,
                    'hypes' => empty($game->hypes) ? 0 : $game->hypes,
                    'name' => $game->name,
                    'popularity' => $game->popularity,
                    'pulse_count' => $game->pulse_count,
                    'rating' => $game->rating,
                    'rating_count' => $game->rating_count,
                    'slug' => $game->slug,
                    'storyline' => $game->storyline,
                    'summary' => $game->summary,
                    'total_rating' => empty($game->total_rating) ? null : $game->total_rating,
                    'total_rating_count' => empty($game->total_rating) ? null : $game->total_rating,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];

                array_push($arrGames, $dataGame);

                //Game Engine
                if (!empty($game->game_engines)) {
                    foreach ($game->game_engines as $engine) {
                        if ($engine instanceof GameEngine) {
                            array_push($arrEngineGames, [
                                'engine_id' => $engine['id'],
                                'game_id' => $game->id,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);

                            if (!in_array($engine['id'], $idEngines)) {
                                array_push($idEngines, $engine['id']);
                                $data = [
                                    'name' => $engine['name'],
                                    'slug' => $engine['slug'],
                                    'logo' => empty($engine->logo->image_id) ? null : $engine->logo->image_id,
                                    'id' => $engine['id'],
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                ];
                                array_push($arrEngines, $data);
                            }
                        }
                    }
                }

                // Keyword
                if (!empty($game->keywords)) {
                    foreach ($game->keywords as $key) {
                        array_push($arrKeywordGame, [
                            'keyword_id' => $key->id,
                            'game_id' => $game->id,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                        if (!in_array($key->id, $idsKey)) {
                            array_push($idsKey, $key->id);
                            $data = [
                                'keyword_id' => $key->id,
                                'name' => $key->name,
                                'slug' => $key->slug,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ];
                            array_push($arrKeyword, $data);
                        }
                    }
                }

                //company develop game
                if (!empty($game->involved_companies)) {
                    foreach ($game->involved_companies as $companyDevelop) {
                        $companyID = $companyDevelop->company->id;

                        array_push($arrCompanyDevelop, [
                            'company_id' => $companyID,
                            'game_id' => $game->id,
                            'developer' => $companyDevelop->developer,
                            'porting' => $companyDevelop->porting,
                            'publisher' => $companyDevelop->publisher,
                            'supporting' => $companyDevelop->supporting,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);

                        if (!in_array($companyID, $idsCompany)) {
                            $company = $companyDevelop->company;
                            $website = [];
                            if (!empty($company->websites)) {
                                foreach ($company->websites as $web) {
                                    if ($web instanceof CompanyWebsite) {
                                        array_push($website, [
                                            'category' => $web->category,
                                            'url' => $web->url
                                        ]);
                                    }
                                }
                            }

                            array_push($idsCompany, $companyID);
                            $data = [
                                'country' => $company->country,
                                'description' => $company->description,
                                'name' => $company->name,
                                'slug' => $company->slug,
                                'logo' => empty($company->logo) || empty($company->logo->image_id) ? null : $company->logo->image_id,
                                'websites' => json_encode($website)
                            ];
                            array_push($arrCompany, $data);
                        }
                    }
                }

                //multiple mode
                if (!empty($game->multiplayer_modes)) {
                    foreach ($game->multiplayer_modes as $mode) {
                        array_push($arrMultipleMode, [
                            'campaigncoop' => $mode->campaigncoop,
                            'dropin' => $mode->dropin,
                            'game_id' => $game->id,
                            'lancoop' => $mode->lancoop,
                            'offlinecoop' => $mode->offlinecoop,
                            'offlinecoopmax' => empty($mode->offlinecoopmax) ? 0 : $mode->offlinecoopmax,
                            'offlinemax' => empty($mode->offlinemax) ? 0 : $mode->offlinemax,

                            'onlinecoop' => $mode->onlinecoop,
                            'onlinecoopmax' => empty($mode->onlinecoopmax) ? 0 : $mode->onlinecoopmax,
                            'onlinemax' => empty($mode->onlinemax) ? 0 : $mode->onlinemax,

                            'platform_id' => empty($mode->platform_id) ? 0 : $mode->platform,
                            'splitscreen' => $mode->splitscreen,

                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                    }
                }

                //game modes
                if (!empty($game->game_modes)) {
                    foreach ($game->game_modes as $gameMode) {
                        array_push($arrGameMode, [
                            'mode_id' => $gameMode->id,
                            'game_id' => $game->id,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                    }
                }

                //game genres
                if (!empty($game->genres)) {
                    foreach ($game->genres as $genre) {
                        array_push($arrGameGenres, [
                            'genre_id' => $genre->id,
                            'game_id' => $game->id,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                    }
                }

                //game platform
                if (!empty($game->platforms)) {
                    foreach ($game->platforms as $platform) {
                        array_push($arrGamePlatforms, [
                            'platform_id' => $platform->id,
                            'game_id' => $game->id,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                    }
                }

                //game release dates
                if (!empty($game->release_dates)) {
                    foreach ($game->release_dates as $date) {
                        array_push($arrGameReleaseDate, [
                            'format_date_id' => $date->category,
                            'game_id' => $game->id,
                            'date' => $date->category === 7 ? null : Carbon::createFromTimestamp($date->date),
                            'human' => $date->human,
                            'm' => $date->m,
                            'y' => $date->y,
                            'platform_id' => $date->platform,
                            'region' => $date->region,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                    }
                }

                //game themes
                if (!empty($game->themes)) {
                    foreach ($game->themes as $theme) {
                        array_push($arrGameThemes, [
                            'theme_id' => $theme->id,
                            'game_id' => $game->id,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                    }
                }
            }
        }


        $this->insertChunk('games', $arrGames);
        $this->insertChunk('engines', $arrEngines);
        $this->insertChunk('game_engines', $arrEngineGames);
        $this->insertChunk('keywords', $arrKeyword);
        $this->insertChunk('keyword_games', $arrKeywordGame);
        $this->insertChunk('companies', $arrCompany);
        $this->insertChunk('involved_companies', $arrCompanyDevelop);
        $this->insertChunk('multiplayer_modes', $arrMultipleMode);
        $this->insertChunk('game_modes', $arrGameMode);
        $this->insertChunk('game_genres', $arrGameGenres);
        $this->insertChunk('game_platforms', $arrGamePlatforms);
        $this->insertChunk('release_dates', $arrGameReleaseDate);
        $this->insertChunk('game_themes', $arrGameThemes);
    }

    public function insertChunk($nameTable, $arrays)
    {
        foreach (array_chunk($arrays, 1000) as $t) {
            DB::table($nameTable)->insert($t);
        }
    }
}
