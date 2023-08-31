<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {   
        User::factory()->create([
            "first_name"=> "ali",
            "last_name"=> "jafari",
            "phone_number"=> "09933861217",
            "password"=> "$2y$10$6d1rLQd0qCxpgpTKGFeN0ulMJ.J5Uw7ItJvzsJtMiCKWIImyR/1SK",
            "age"=> "22",
            "gender"=> "male",
        ]);
    }
}
