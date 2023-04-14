<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Faker\Provider\Image;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $faker->addProvider(new Image($faker));

        // Create 20 users
        for ($i = 0; $i < 20; $i++) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'password' => bcrypt('password123'),
                'role' => $faker->randomElement(['landlord', 'tenant']),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Create landlords
        $users = DB::table('users')->where('role', 'landlord')->get();
        foreach ($users as $user) {
            DB::table('landlords')->insert([
                'user_id' => $user->unique()->id,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'imagePath' => $faker->imageUrl($width = 640, $height = 480),
                'is_received' => false,
                'is_upgraded' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Create tenants
        $users = DB::table('users')->where('role', 'tenant')->get();
        foreach ($users as $user) {
            DB::table('tenants')->insert([
                'user_id' => $user->unique()->id,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'imagePath' => $faker->imageUrl($width = 640, $height = 480),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Create admin
        $user = DB::table('users')->where('email', 'admin@example.com')->first();
        if ($user) {
        DB::table('admins')->insert([
            'user_id' => $user->id,
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'phone' => $faker->phoneNumber,
            'address' => $faker->address,
            'imagePath' => $faker->imageUrl($width = 640, $height = 480),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
    }
}

