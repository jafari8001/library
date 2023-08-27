<?php

function showResponse($status, $message, $data=""){
    return Response()->json([
        "status"=> $status,
        "message"=> $message,
        "data"=> $data,
    ]);
}


