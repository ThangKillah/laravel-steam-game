<?php

use Illuminate\Database\Seeder;
use MarcReichel\IGDBLaravel\Models\Theme;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $themes = Theme::all();
        $arrData = [];

        foreach ($themes as $theme) {
            array_push($arrData, [
                'id' => $theme->id,
                'name' => $theme->name,
                'slug' => $theme->slug
            ]);
        }
        DB::table('themes')->insert($arrData);

    }
}
