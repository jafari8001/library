<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
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
        Role::insertData([
            "name"=> "admin",
        ]);
        $user = User::findDataById(1);
        $role = Role::find(1);
        $user->roles()->save($role);
    }
}
