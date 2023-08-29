<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TokenController extends Controller
{
    public static function genrateToken(){
        $result = bin2hex(random_bytes(32));
        return $result;
    }
}
