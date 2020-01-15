<?php

use App\Model\Association;
use App\Model\AssociationBlog;
use App\Model\Blog;
use App\Traits\GameSpotApi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GameSpotBlogSeeder extends Seeder
{
    use GameSpotApi;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10000; $i++) {
            $blogs = $this->getBlog($i);
            if (!empty($blogs)) {
                if ($blogs['number_of_page_results'] === 0) {
                    break;
                }
                foreach ($blogs['results'] as $blog) {
                    $blogDB = Blog::create(
                        [
                            'author_id' => 0,
                            'title' => $blog['title'],
                            'slug' => Str::slug($blog['title'], '-'),
                            'deck' => $blog['deck'],
                            'body' => $blog['body'],
                            'image' => json_encode($blog['image']),
                            'publish_date' => $blog['publish_date'],
                            'created_at' => now(),
                            'updated_at' => now()
                        ]
                    );
                    if (!empty($blog['associations'])) {
                        foreach ($blog['associations'] as $item) {
                            $type = 0;
                            $core_id = 0;
                            if (!empty($item['api_detail_url'])) {
                                if (strpos($item['api_detail_url'], 'www.gamespot.com/api/events') !== false) {
                                    $type = Association::EVENTS;
                                    $event = \App\Model\Event::firstOrCreate(
                                        ['name' => $item['name']],
                                        [
                                            'name' => $item['name']
                                        ]
                                    );
                                    $core_id = $event->id;
                                }
                                if (strpos($item['api_detail_url'], 'www.gamespot.com/api/games') !== false) {
                                    $type = Association::GAMES;
                                    $game = \App\Model\Game::where('name', 'like', '%' . $item['name'] . '%')->first();
                                    $core_id = empty($game) ? 0 : $game->game_id;
                                }
                            } else {
                                $type = Association::PLATFORMS;
                                $platform = \App\Model\Platform::where('name', $item['name'])->first();
                                $core_id = empty($platform) ? 0 : $platform->id;
                            }

                            if ($type != 0 && $core_id != 0) {
                                $association = Association::firstOrCreate(
                                    ['core_id' => $core_id, 'type' => $type],
                                    [
                                        'name' => $item['name']
                                    ]
                                );
                                AssociationBlog::firstOrCreate(
                                    ['association_id' => $association->id, 'blog_id' => $blogDB->id]
                                );
                            }
                        }
                    }
                }
            }
        }
    }
}
