<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exceptions\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController{
    use AuthorizesRequests, ValidatesRequests;
    protected $model_name; 
    protected $rules = [];
    protected $data_inputs = [];

    protected function validateRequest(Request $request, $rules = []){
        $validated = Validator::make($request->all(), $rules);
        
        if ($validated->fails()){
            throw new ValidationException();
        }
    }
    public function listData(Request $request){
        return showResponse(
                200,
                'users in dataase', 
                $this->model_name::getAllData($request),
            );
    }
    public function getDataById(Request $request){
        $user = $this->model_name::findDataById($request['id']);
        if ($user == false) {
            return showResponse(
                404,
                "User not found"
            );
        }
        return showResponse(
            200,
            "Find Data succesfull",
            $user);
    }
    public function addData(Request $request){
        $this->validateRequest($request, $this->rules);
        $data = $request->only($this->data_inputs);
        return showResponse(
            200,
            "Add user successfull",
            $this->model_name::insertData($data)
        );
    }
    public function editData(Request $request){
        $user = $this->model_name::findDataById($request->id);
        if ($user == false) {
            return showResponse(
                404,
                "User not found"
            );
        }
        $data = $request->only($this->data_inputs);
        return showResponse(
            200,
            "Edit user successfull",
            $this->model_name::editData($data, $user)
        );
    }
    public function deleteData(Request $request){
        $user = $this->model_name::findDataById($request['id']);
        if ($user == false) {
            return showResponse(
                404,
                "User not found"
            );
        }
        return showResponse(
            200,
            "Removing successfull",
            $this->model_name::deleteData($user));
    }

    
}
