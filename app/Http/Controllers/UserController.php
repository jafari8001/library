<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
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

    public function get_user( $id = null){
        if ($id == null) {
            return Response()->json(User::all());
        }
        return Response()->json(User::where('id', $id)->get());
    }

    public function edit_user(Request $request, $id){
        try {
            $user = User::find($id);
            $user->update($request->all());
            return Response()->json([
                'status'=> 201,
                'message'=>'updating user successfull',
                'data'=>''
            ]);
        } catch (Exception $err) {
                return Response()->json([
                'status'=> $err->getCode(),
                'message'=>$err->getMessage(),
                'data'=>''
            ]);
        }
    }

    public function delete_user($id){
        $user = User::find($id)->delete();
        if($user){
            return Response()->json([
                'status'=> 201,
                'message'=> 'User removing seccessful',
                'data'=> "",
            ]);
        }else {
            return Response()->json([
                'status'=> 400,
                'message'=> 'User removing faild',
                'data'=> "",
            ]);
        }
    }

    public function count_loan($id){
        $user = User::find($id)->loans;
        return Response()->json(count($user));
    }
}
