<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            "first_name"=> "ali",
            "last_name"=>"jafari",
            "password"=>"1234",
            "age"=>22,
            "gender"=>"male",
        ]);
    }
}
