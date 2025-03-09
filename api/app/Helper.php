<?php

use Illuminate\Support\Facades\Http;

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
        'message' => $message,
        'status' => 'success'
    ], 200);
}

function error($data, $message = '') {
    return response()->json([
        'data' => $data,
        'message' => $message,
        'status' => 'error'
    ], 500);
}

function eventBriteRequest() {
    return Http::withHeaders([
        'Authorization' => 'Bearer ' . env('EVENTBRITE_API_KEY'),
    ])
    ->acceptJson();
}
