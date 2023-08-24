<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUsers(){
        return Response()->json(User::getAllUsers());
    }
    public function addUser(Request $request){
        $data = $request->only([
            "first_name",
            "last_name",
            "age",
            "gender",
        ]);
        return Response()->json(User::insertUser($data));
    }
    public function editUser(Request $request){
        $user = User::findUserById($request->id);
        $data = $request->only([
            "first_name",
            "last_name",
            "age",
            "gender",
        ]);
        return Response()->json(User::editUser($data, $user));
    }
    public function deleteUser(Request $request){
        $user = User::findUserById($request->id);
        return Response()->json(User::deleteUser($user));
    }
    public function countLoan(Request $request){
        $load_number = UserService::getLoanCount($request->id);
        return Response()->json($load_number);
    }
    public function getUserById(Request $request){
        return Response()->json(User::findUserById($request->id));
    }
}
