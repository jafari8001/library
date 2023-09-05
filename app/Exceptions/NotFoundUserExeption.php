<?php

namespace App\Exceptions;

use Exception;

class NotFoundUserExeption extends Exception
{
    public function render($request){
        return Response()->json([
            'status'=> 404,
            'message'=> 'User not found',
            'data'=> []
        ]);
    }
}
