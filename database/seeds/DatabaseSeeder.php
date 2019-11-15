<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        $this->call(CategorySeeder::class);
//        $this->call(DateFormatSeeder::class);
//        $this->call(PlatformSeeder::class);
        $this->call(ThemeSeeder::class);
    }
}
