<?php 

namespace App\Services;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Auth;

class UserService {

    public static function checkUserExist($request){
        $user = User::getUserByPhoneNumber($request);
        if ($user) {
            $plain_text = $request->password;
            $pass = $user->password;
            if (Hash::check($plain_text, $pass)) {
                return $user;
            }
        }
        return false;
    }
    public static function genrateToken(){
        $result = bin2hex(random_bytes(32));
        return $result;
    }
    public static function chechPermision($user){
        dd($user);
    }
    public static function getLoanCount($id){
        return User::find($id)->loans()->count();
    }
}