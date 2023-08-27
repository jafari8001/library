<?php

namespace App\Http\Controllers;

use App\Exceptions\ValidationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        return Response()->json($this->model_name::getAllData($request));
    }
    public function getDataById(Request $request){
        return Response()->json($this->model_name::findDataById($request->id));
    }
    public function addData(Request $request){
        $this->validateRequest($request, $this->rules);
        $data = $request->only($this->data_inputs);
        return Response()->json($this->model_name::insertData($data));
    }
    public function editData(Request $request){
        $user = $this->model_name::findDataById($request->id);
        $data = $request->only($this->data_inputs);
        return Response()->json($this->model_name::editData($data, $user));
    }
    public function deleteData(Request $request){
        $user = $this->model_name::findDataById($request->id);
        return Response()->json($this->model_name::deleteData($user));
    }

    
}
