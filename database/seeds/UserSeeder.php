<?php

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            $credentials = [
                'email' => 'email' . $i . '@gmail.com',
                'name' => 'mylove' . $i,
                'password' => 'thunga28091997',
            ];
            Sentinel::registerAndActivate($credentials);
        }

        $comments = [
            [
                'id' => 1,
                'type' => 1,
                'user_id' => 1,
                'core_id' => 238,
                'content' => '<p>9/10 I will recommend this game at full price</p>',
                'parent_id' => 0,
                'like' => 0,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null
            ],
            [
                'id' => 2,
                'type' => 1,
                'user_id' => 2,
                'core_id' => 238,
                'content' => '<p>If I want my life to be hard, I just talk with a girl instead of playing this.</p>',
                'parent_id' => 1,
                'like' => 0,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null
            ],
            [
                'id' => 3,
                'type' => 1,
                'user_id' => 3,
                'core_id' => 238,
                'content' => '<p>10/10 Game is pretty dope, not gonna lie</p>',
                'parent_id' => 0,
                'like' => 0,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null
            ],
            [
                'id' => 4,
                'type' => 1,
                'user_id' => 4,
                'core_id' => 238,
                'content' => '<p>The story and playstyle is so cool</p>',
                'parent_id' => 0,
                'like' => 0,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null
            ]
        ];

        DB::table('comments')->insert($comments);

    }
}
