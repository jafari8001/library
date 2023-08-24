<?php 

namespace App\Services;
use App\Models\User;

class UserService {
    public static function getLoanCount($id){
        return User::find($id)->loans()->count();
    }
}