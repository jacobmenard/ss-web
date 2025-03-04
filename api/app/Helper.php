<?php

/**
 * Generate a random string.
 *
 * @param  int  $length
 * @return string
 */
function generateRandomString($length = 10)
{
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)))), 1, $length);
}

function success($data, $message = '') {
    return response()->json([
        'data' => $data,
        'message' => $message
    ], 200);
}

function error($data, $message = '') {
    return response()->json([
        'data' => $data,
        'message' => $message
    ], 500);
}