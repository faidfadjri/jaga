<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CrimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('criminal_records')->insert([
                'userId'      => 2,
                'crimeType'   => $faker->word,
                'description' => $faker->sentence,
                'date'        => $faker->date($format = 'Y-m-d', $max = 'now'),
                'location'    => $faker->city
            ]);
        }
    }
}
