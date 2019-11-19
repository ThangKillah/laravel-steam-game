<?php

use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        $genres = \MarcReichel\IGDBLaravel\Models\Genre::all();
        foreach ($genres as $genre) {
            array_push($data, [
                'id' => $genre->id,
                'name' => $genre->name,
                'slug' => $genre->slug
            ]);
        }
        DB::table('genres')->insert($data);
    }
}
