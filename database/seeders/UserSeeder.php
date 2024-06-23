<?php

namespace Database\Seeders;

use App\Models\Auth\Users;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'username' => 'admin',
                'fullName' => 'Admin',
                'phone'    => '021',
                'email'    => 'admin@gmail.com',
                'role'     => 'admin',
                'password' => Hash::make('password')
            ],
        ];

        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            $users[] = [
                'username' => $faker->userName,
                'fullName' => $faker->name,
                'phone'    => $faker->phoneNumber,
                'email'    => $faker->unique()->safeEmail,
                'role'     => 'user',
                'password' => Hash::make('password')
            ];
        }

        foreach ($users as $user) {
            Users::create($user);
        }
    }
}
