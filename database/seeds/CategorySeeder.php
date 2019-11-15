<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'main_game', 'value' => 0],
            ['name' => 'dlc_addon', 'value' => 1],
            ['name' => 'expansion', 'value' => 2],
            ['name' => 'bundle', 'value' => 3],
            ['name' => 'standalone_expansion', 'value' => 4],
        ]);

        DB::table('status')->insert([
            ['name' => 'released', 'value' => 0],
            ['name' => 'alpha', 'value' => 2],
            ['name' => 'beta', 'value' => 3],
            ['name' => 'early_access', 'value' => 4],
            ['name' => 'offline', 'value' => 5],
            ['name' => 'cancelled', 'value' => 6],
        ]);

        DB::table('category_websites')->insert([
            ['name' => 'official', 'value' => 1],
            ['name' => 'wikia', 'value' => 2],
            ['name' => 'wikipedia', 'value' => 3],
            ['name' => 'facebook', 'value' => 4],
            ['name' => 'twitter', 'value' => 5],
            ['name' => 'twitch', 'value' => 6],
            ['name' => 'instagram', 'value' => 8],
            ['name' => 'youtube', 'value' => 9],
            ['name' => 'iphone', 'value' => 10],
            ['name' => 'ipad', 'value' => 11],
            ['name' => 'android', 'value' => 12],
            ['name' => 'steam', 'value' => 13],
            ['name' => 'reddit', 'value' => 14],
            ['name' => 'discord', 'value' => 15],
            ['name' => 'google_plus', 'value' => 16],
            ['name' => 'tumblr', 'value' => 17],
            ['name' => 'linkedin', 'value' => 18],
            ['name' => 'pinterest', 'value' => 19],
            ['name' => 'soundcloud', 'value' => 20],
        ]);
    }
}
