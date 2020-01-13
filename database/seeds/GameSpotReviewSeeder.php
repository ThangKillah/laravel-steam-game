<?php

use App\Traits\GameSpotApi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GameSpotReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    use GameSpotApi;

    public function run()
    {
        $reviewIds = \App\Model\Review::all()->pluck('gamespot_id')->toArray();

        for ($i = 1; $i <= 10000; $i++) {
            $reviews = $this->getReview($i);
            if (!empty($reviews)) {
                if ($reviews['number_of_page_results'] === 0) {
                    break;
                } else {
                    $data = [];
                    foreach ($reviews['results'] as $item) {
                        if (!empty($item['game']) && !in_array($item['id'], $reviewIds)) {

                            $arrPlat = [];
                            if (!empty($item['releases'])) {
                                foreach ($item['releases'] as $plat) {
                                    $arrPlat[] = $plat['platform'];
                                }
                            }
                            $arrPlat = array_intersect(
                                $arrPlat,
                                ['Linux', 'PC', 'PlayStation 3', 'Xbox 360', 'Mac', 'PlayStation 4', 'Xbox One', 'Nintendo Switch']
                            );

                            $game = \App\Model\Game::where('slug', explode("/", $item['game']["site_detail_url"])[3])->first();

                            if (!empty($game)) {
                                $insertData = [
                                    'author_id' => 0,
                                    'title' => $item['title'],
                                    'slug' => Str::slug($item['title'], '-'),
                                    'deck' => $item['deck'],
                                    'body' => $item['body'],
                                    'good' => $item['good'],
                                    'bad' => $item['bad'],
                                    'publish_date' => $item['publish_date'],
                                    'edit_date' => $item['update_date'],
                                    'score' => $item['score'],
                                    'review_type' => $item['review_type'],
                                    'image' => json_encode($item['image']),
                                    'game_id' => $game->game_id,
                                    'created_at' => now(),
                                    'updated_at' => now(),
                                    'platform_id' => empty($arrPlat) ? 0 : \App\Model\Platform::where('name', $arrPlat[array_rand($arrPlat)])->first()->id,
                                ];
                                array_push($data, $insertData);
                            }
                        }
                    }
                    DB::table('reviews')->insert($data);
                }
            }
        }
    }
}
