<?php

namespace App\Exceptions;

use Exception;

class PermisionError extends Exception
{
    public function render($request){
        return Response()->json([
            'status'=> 400,
            'message'=> 'Permision Error',
            'data'=> []
        ]);
    }
}
