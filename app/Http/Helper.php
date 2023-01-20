<?php
if (!function_exists('json_response')) {
    function json_response($success = 1, $message, $code = 200, $data = null)
    {
        $success = $success == 1 ? true : false;
        return response()->json([
            'success' => $success,
            'message' => $message,
            'data' => $data
        ], $code);
    }
}
