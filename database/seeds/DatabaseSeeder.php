<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        try {
            $this->call(CategorySeeder::class);
            $this->call(DateFormatSeeder::class);
            $this->call(PlatformSeeder::class);
            $this->call(ThemeSeeder::class);
            $this->call(ModeSeeder::class);
            $this->call(GenreSeeder::class);
            $this->call(GameSeeder::class);
            $this->call(GameSpotReviewSeeder::class);
            $this->call(GameSpotBlogSeeder::class);
            DB::commit();
        } catch (Exception $e) {
            Log::info($e);
            DB::rollback();
        }
    }
}
