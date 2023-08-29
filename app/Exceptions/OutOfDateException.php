<?php

namespace App\Exceptions;

use Exception;

class OutOfDateException extends Exception
{
    public function render($request){
        return Response()->json([
            'status'=> 400,
            'message'=> 'Token is expire',
            'data'=> []
        ]);
    }
}
