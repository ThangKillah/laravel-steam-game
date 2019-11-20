<?php

use Illuminate\Database\Seeder;
use MarcReichel\IGDBLaravel\Models\Platform;

class PlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $platforms = Platform::where('name', 'Mac')
            ->orWhere('name', 'Linux')
            ->orWhere('name', 'PC (Microsoft Windows)')
            ->orWhere('name', 'Nintendo Switch')
            ->orWhere('name', 'PlayStation 4')
            ->orWhere('name', 'Xbox One')
            ->orWhere('name', 'Xbox 360')
            ->orWhere('name', 'PlayStation 3')
            ->with(['platform_logo', 'websites'])
            ->get();

        $arrPlatforms = [];

        foreach ($platforms as $platform) {
            $websites = [];
            if (!empty($platform->websites)) {
                foreach ($platform->websites as $web) {
                    array_push($websites, [
                        'category' => $web->category,
                        'url' => $web->url
                    ]);
                }
            }

            $data = [
                'id' => $platform->id,
                'name' => $platform->name,
                'slug' => $platform->slug,
                'des' => $platform->sumary,
                'websites' => json_encode($websites),
                'logo' => $platform->name === 'Xbox One' ? 'https://upload.wikimedia.org/wikipedia/commons/f/f9/Xbox_one_logo.svg' :
                    'https://images.igdb.com/igdb/image/upload/t_thumb/' . $platform->platform_logo->image_id . '.jpg'
            ];
            array_push($arrPlatforms, $data);
        }

        DB::table('platforms')->insert($arrPlatforms);
    }
}
