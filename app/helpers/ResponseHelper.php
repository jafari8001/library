<?php

namespace App\helpers;

class ResponseHelper {
    public static function showResponse($status, $message, $data=""){
        return [
            "status"=> $status,
            "message"=> $message,
            "data"=> $data,
        ];
    }
}

