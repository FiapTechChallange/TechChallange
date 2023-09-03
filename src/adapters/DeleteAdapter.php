<?php

namespace App\adapters;

class DeleteAdapter
{
    public static function json($response)
    {
        try{
            header('Content-Type: application/json; charset=utf-8');
            http_response_code(204);
            return json_encode([]);

        } catch (\Exception $e) {
            return json_encode([
                'error' => true,
                'status' => $e->getCode(),
                'msg' => $e->getMessage()
            ]);
        }
    }
}