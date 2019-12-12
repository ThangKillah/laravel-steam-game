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
                'content' => '<p>Awesome these are news we were looking for, thanks yakuthemes best thing i\'ve heard today, but more game modes are welcome.</p> <p>Maecenas at tristique dolor, nec condimentum tellus. Fusce in aliquet augue. Sed non rhoncus ante, sed posuere neque. Suspendisse ac maximus arcu, at ornare nulla. Sed metus tellus, lobortis ut dignissim sed, consequat sit amet mi.</p>',
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
                'content' => '<p>Please also consider replacing Battles with Blast (in Skirmish): it can use the same AI and would be much more fun (tokens are annoying and maps are limited)!</p>',
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
                'content' => '<p>Please also consider replacing Battles with Blast (in Skirmish): it can use the same AI and would be much more fun (tokens are annoying and maps are limited)!</p>',
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
                'content' => '<p>Please also consider replacing Battles with Blast (in Skirmish): it can use the same AI and would be much more fun (tokens are annoying and maps are limited)!</p>',
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
