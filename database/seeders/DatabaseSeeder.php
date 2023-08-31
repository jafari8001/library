<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            "first_name"=> "ali",
            "last_name"=> "jafari",
            "phone_number"=> "09933861217",
            "password"=> "$2y$10$6d1rLQd0qCxpgpTKGFeN0ulMJ.J5Uw7ItJvzsJtMiCKWIImyR/1SK",
            "age"=> "22",
            "gender"=> "male",
        ]);
    }
}
