<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'age' => 'required|integer|min:0',
        'gender' => 'required|in:male,female',
    ];
    protected $data_inputs = [
        "first_name",
        "last_name",
        "age",
        "gender"
    ];
    protected $model_name = User::class;
    
    public function countLoan(Request $request){
        $load_number = UserService::getLoanCount($request->id);
        return Response()->json($load_number);
    }
}
