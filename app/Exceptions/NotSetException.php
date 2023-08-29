<?php

namespace App\Exceptions;

use Exception;

class NotSetException extends Exception
{
    public function render($request){
        return Response()->json([
            'status'=> 400,
            'message'=> 'Token not set',
            'data'=> []
        ]);
    }
}
