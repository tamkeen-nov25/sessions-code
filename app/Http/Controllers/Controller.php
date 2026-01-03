<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function successResponse($message = "success", $data = [], $statusCode = 200){
        return response()->json([
            'message' => $message,
            'data' => $data
        ],$statusCode);
    }
}
