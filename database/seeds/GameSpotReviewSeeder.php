<?php

use App\Traits\GameSpotApi;
use Illuminate\Database\Seeder;

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
        DB::table('reviews')->truncate();

        for ($i = 1; $i <= 10000; $i++) {
            $reviews = $this->getReview($i);
            if (!empty($reviews)) {
                if ($reviews['number_of_page_results'] === 0) {
                    break;
                } else {
                    $data = [];
                    foreach ($reviews['results'] as $item) {
                        if (!empty($item['game'])) {

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

                            $insertData = [
                                'id_review' => $item['id'],
                                'authors' => $item['authors'],
                                'title' => $item['title'],
                                'deck' => $item['deck'],
                                'body' => $item['body'],
                                'good' => $item['good'],
                                'bad' => $item['bad'],
                                'publish_date' => $item['publish_date'],
                                'edit_date' => $item['update_date'],
                                'score' => $item['score'],
                                'review_type' => $item['review_type'],
                                'site_detail_url' => $item['site_detail_url'],
                                'image' => json_encode($item['image']),
                                'game' => explode("/", $item['game']["site_detail_url"])[3],
                                'created_at' => now(),
                                'updated_at' => now(),
                                'platform' => empty($arrPlat) ? null : $arrPlat[array_rand($arrPlat)],
                                'stt' => 2
                            ];
                            array_push($data, $insertData);
                        }
                    }
                    DB::table('reviews')->insert($data);
                }
            }
        }
    }
}
