<?php

namespace App\Exceptions;

use Exception;

class ValidationException extends Exception{
    public function render($request){
        return Response()->json([
            'status'=> 412,
            'message'=> 'Validation failed',
            'data'=> []
        ]);
    }
}
