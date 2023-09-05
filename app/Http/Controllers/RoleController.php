<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller{
    protected $rules = [
        'name' => 'required|string|max:255'
    ];
    protected $data_inputs = [
        "name"
    ];
    protected $model_name = Role::class;

    public function addRoleToUser(Request $request){
        $this->validateRequest($request,[
            'user_id' => 'required',
            'role_id' => 'required'
        ]);
        return showResponse(
            200,
            'Role added to user', 
            $this->model_name::addRoleToUser($request)
        );
    }
}
