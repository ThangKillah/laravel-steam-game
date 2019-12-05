<?php

use App\Model\Association;
use App\Model\AssociationBlog;
use App\Model\Blog;
use App\Traits\GameSpotApi;
use Illuminate\Database\Seeder;

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
                    $blogDB = Blog::firstOrCreate(
                        ['gamespot_id' => $blog['id']],
                        [
                            'authors' => $blog['authors'],
                            'title' => $blog['title'],
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
                            $type = '';
                            if (!empty($item['api_detail_url'])) {
                                if (strpos($item['api_detail_url'], 'www.gamespot.com/api/events') !== false) {
                                    $type = 'events';
                                }
                                if (strpos($item['api_detail_url'], 'www.gamespot.com/api/games') !== false) {
                                    $type = 'games';
                                }
                            } else {
                                $type = 'platform';
                            }
                            $association = Association::firstOrCreate(
                                ['association_id' => $item['id'], 'type' => $type],
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
