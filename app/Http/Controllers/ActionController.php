<?php

namespace App\Http\Controllers;

use App\Models\Action;
use Illuminate\Http\Request;

class ActionController extends Controller
{
    protected $rules = [
        'route_name' => 'required|string|max:255',
        'fa_name' => 'required|string|max:255'
    ];
    protected $data_inputs = [
        "route_name",
        "fa_name"
    ];
    protected $model_name = Action::class;

    public function addActionToRole(Request $request){
        $this->validateRequest($request,[
            'action_id' => 'required',
            'role_id' => 'required'
        ]);
        
        $result = $this->model_name::addActionToRole($request);

        return showResponse(
            200,
            'Role added to user', 
            $result
        );
    }
}
