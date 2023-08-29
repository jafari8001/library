<?php

namespace App\Http\Controllers;

use App\Models\Token;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'phone_number' => 'required|string|max:255',
        'password' => 'required|string|max:255',
        'age' => 'required|integer|min:0',
        'gender' => 'required|in:male,female',
    ];
    protected $data_inputs = [
        "first_name",
        "last_name",
        "password",
        "phone_number",
        "age",
        "gender"
    ];
    protected $model_name = User::class;

    public function login(Request $request){
        $this->validateRequest($request, [
            'phone_number' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);
        $user = $this->checkUserExist($request);
        if ($user) {
            $data = [
                "user_id"=> $user['id'],
                "token"=> TokenController::genrateToken(),
                "expire_token"=> Carbon::now()->addDays(30),
            ];
            return Token::insertToken($data);
        }
        return "user not found";
    }
    public function checkUserExist($request){
        $user = User::where('phone_number', $request['phone_number'])->first();
        $plain_text = $request->password;
        $pass = $user->password;
        if (Hash::check($plain_text, $pass)) {
            return $user;
        }
        return false;
    }
    
    public function countLoan(Request $request){
        $load_number = UserService::getLoanCount($request->id);
        return Response()->json($load_number);
    }

}
