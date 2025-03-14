<?php

namespace App\Helpers;

if(!function_exists('ApiResponse')) {

    function ApiResponse($code, $data = [], $message = null) {
        return [
            'code'=> $code,
            'message' => $message ?? ($code != 200 ? 'Something went wrong' : 'Success'),
            'data' => $data
        ];
    }
}

?>

