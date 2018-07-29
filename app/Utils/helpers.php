<?php


function api_response($message, $content = null, $code = 200)
{
    return response()->json([
        'code' => $code,
        'message' => $message,
        'content' => $content
    ], $code);
}