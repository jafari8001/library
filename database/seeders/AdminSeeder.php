<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {   
        User::insertData([
            "first_name"=> "ali",
            "last_name"=> "jafari",
            "phone_number"=> "09933861217",
            "password"=> "jafari8001@",
            "age"=> "22",
            "gender"=> "male",
        ]);
    }
}
