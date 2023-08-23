<?php 

namespace App\Services;
use App\Models\User;

class UserService {
    public static function getLoanCount($user_id){
        return User::find($user_id)->loans()->count();
    }
}