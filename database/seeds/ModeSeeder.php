<?php

use Illuminate\Database\Seeder;

class ModeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        $modes = \MarcReichel\IGDBLaravel\Models\GameMode::all();
        foreach ($modes as $mode) {
            array_push($data, [
                'id' => $mode->id,
                'name' => $mode->name,
                'slug' => $mode->slug
            ]);
        }
        DB::table('modes')->insert($data);
    }
}
