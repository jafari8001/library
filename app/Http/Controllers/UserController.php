<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Response;

class UserController extends Controller
{
    public function add_user(Request $request){
        $data = $request->only([
            "first_name",
            "last_name",
            "age",
            "gender",
        ]);

        $create = User::create($data);
        return Response()->json(
            [
                "status"=>'200',
                "message"=>'User created',
                "data"=> $create,
            ]
        );
    }
}
