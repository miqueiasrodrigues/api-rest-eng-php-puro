<?php

namespace App;

require_once __DIR__ . '/../Config/config.php';

class Response
{
    public static function json(int $status = 200, string $message = 'success', $data = null)
    {
        $statusText = self::statusMap($status); 

        $response = json_encode([
            'status' => API_IS_ACTIVE ? $statusText : 'error', 
            'message' => API_IS_ACTIVE ? $message : 'API is not running.',
            'data' => API_IS_ACTIVE ? $data : null,
        ]);

        return $response;
    }

    private static function statusMap(int $status)
    {
        if ($status < 300) {
            return "success";
        } elseif ($status >= 300 && $status < 400) {
            return "error";
        } elseif ($status >= 400 && $status < 500) {
            return "error";
        } elseif ($status >= 500 && $status < 600) {
            return "error";
        } else {
            return "error";
        }
    }
}
