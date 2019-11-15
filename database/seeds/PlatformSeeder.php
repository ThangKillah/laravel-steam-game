<?php

use Illuminate\Database\Seeder;

class PlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('platforms')->insert([
            [
                'id' => config('constant.pc_id_platform'),
                'name' => 'PC',
                'slug' => 'win',
                'logo' => 'https://images.igdb.com/igdb/image/upload/t_thumb/irwvwpl023f8y19tidgq.jpg',
                'des' => '',
                'websites' => json_encode(
                    ['category' => 1, 'url' => 'http://windows.microsoft.com/']
                )
            ],
            [
                'id' => config('constant.ps4_id_platform'),
                'name' => 'PlayStation 4',
                'slug' => 'ps4--1',
                'logo' => 'https://images.igdb.com/igdb/image/upload/t_thumb/pl6f.jpg',
                'des' => 'The PlayStation 4 system opens the door to an incredible journey through immersive new gaming worlds and a deeply connected gaming community. PS4 puts gamers first with an astounding launch line-up and over 180 games in development. Play amazing top-tier blockbusters and innovative indie hits on PS4. Developer inspired, gamer focused.',
                'websites' => json_encode(
                    ['category' => 1, 'url' => 'http://www.playstation.com/ps4/']
                )
            ],
            [
                'id' => config('constant.xbox_one_id_platform'),
                'name' => 'Xbox One',
                'slug' => 'xboxone',
                'des' => 'Welcome to a new generation of games and entertainment. Where games push the boundaries of realism. And television obeys your every command. Where listening to music while playing a game is a snap. And you can jump from TV to movies to music to a game in an instant. Where your experience is custom tailored to you. And the entertainment you love is all in one place. Welcome to the all-in-one, Xbox One',
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/f/f9/Xbox_one_logo.svg',
                'websites' => json_encode(
                    ['category' => 1, 'url' => 'http://www.xbox.com/en-US/xbox-one']
                )
            ]
        ]);
    }
}
