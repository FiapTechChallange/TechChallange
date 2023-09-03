<?php

namespace App\adapters;

class ListAdapter
{
    public static function json($response)
    {
        try{
            header('Content-Type: application/json; charset=utf-8');
            http_response_code(200);
            return json_encode([
                'error' => false,
                'data' => $response
            ]);

        } catch (\Exception $e) {
            return json_encode([
                'error' => true,
                'status' => $e->getCode(),
                'msg' => $e->getMessage()
            ]);
        }
    }
}