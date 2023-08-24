<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected $rules = [
        'user' => [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'gender' => 'required|in:male,female',
        ],
        'book' => [
            
        ],
    ];

    protected function validateRequest(Request $request, $type)
    {
        $validated = Validator::make($request->all(), $this->rules[$type]);

        if ($validated->fails()) {
            return response()->json(
                [
                    'status'=> 400,
                    'message'=>$validated->errors()
                ]
            );
        }
        return true;
    }
}
