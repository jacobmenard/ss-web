<?php
namespace App\Http;

class Helper
{
    /**
     * Generate a random string.
     *
     * @param  int  $length
     * @return string
     */
    public static function generateRandomString($length = 10)
    {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)))), 1, $length);
    }

    function success($data) {
        return response()->json($data, 200);
    }
}