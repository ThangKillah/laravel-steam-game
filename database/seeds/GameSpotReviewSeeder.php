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
        for ($i = 1; $i <= 10000; $i++) {
            $reviews = $this->getReview($i);
            if (!empty($reviews)) {
                if ($reviews['number_of_page_results'] === 0) {
                    break;
                } else {
                    $data = [];
                    foreach ($reviews['results'] as $item) {
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
                            'game' => empty($item['game']) ? null : explode("/", $item['game']["site_detail_url"])[3],
                            'created_at' => now(),
                            'updated_at' => now()
                        ];
                        array_push($data, $insertData);
                    }
                    DB::table('gamespot_reviews')->insert($data);
                }
            }
        }
    }
}
