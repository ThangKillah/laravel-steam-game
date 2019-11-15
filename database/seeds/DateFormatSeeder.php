<?php

use Illuminate\Database\Seeder;

class DateFormatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('format_dates')->insert([
            ['name' => 'YYYYMMMMDD', 'value' => 0],
            ['name' => 'YYYYMMMM', 'value' => 1],
            ['name' => 'YYYY', 'value' => 2],
            ['name' => 'YYYYQ1', 'value' => 3],
            ['name' => 'YYYYQ2', 'value' => 4],
            ['name' => 'YYYYQ3', 'value' => 5],
            ['name' => 'YYYYQ4', 'value' => 6],
            ['name' => 'TBD', 'value' => 7],
        ]);

        DB::table('regions')->insert([
            ['name' => 'europe', 'value' => 1],
            ['name' => 'north_america', 'value' => 2],
            ['name' => 'australia', 'value' => 3],
            ['name' => 'new_zealand', 'value' => 4],
            ['name' => 'japan', 'value' => 5],
            ['name' => 'china', 'value' => 6],
            ['name' => 'asia', 'value' => 7],
            ['name' => 'worldwide', 'value' => 8],
        ]);
    }
}
