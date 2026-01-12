<?php


function successResponse($message = "success", $statusCode = 200, $data = [])
{
    return response()->json([
        'message' => $message,
        'data' => $data
    ], $statusCode);
}function failedResponse($message = "failed", $statusCode = 400, $data = [])
{
    return response()->json([
        'message' => $message,
        'data' => $data
    ], $statusCode);
}
