<?php

namespace App\Http\Controllers;

use App\Exceptions\ValidationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function validateRequest(Request $request, $rules = []){
        $validated = Validator::make($request->all(), $rules);
        
        if ($validated->fails()){
            throw new ValidationException();
        }
    }
}
