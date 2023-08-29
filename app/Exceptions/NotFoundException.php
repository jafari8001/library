<?php

namespace App\Exceptions;

use Exception;

class NotFoundException extends Exception
{
    public function render($request){
        return Response()->json([
            'status'=> 400,
            'message'=> 'This token not exist',
            'data'=> []
        ]);
    }
}
