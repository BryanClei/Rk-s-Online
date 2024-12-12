<?php

namespace App\Functions;

use App\Response\Message;

class GlobalFunctions
{
    public static function created($message, $result = [])
    {
        return response()->json(
            [
                "message" => $message,
                "result" => $result,
            ],
            Message::CREATED_STATUS
        );
    }

    public static function display($message, $result = [])
    {
        return response()->json(
            [
                "message" => $message,
                "result" => $result,
            ],
            Message::SUCESS_STATUS
        );
    }

    public static function login($message, $user)
    {
        return response()->json(
            [
                "message" => $message,
                "result" => $user,
            ],
            Message::SUCESS_STATUS
        );
    }

    public static function notFound($message)
    {
        return response()->json(
            ["message" => $message],
            Message::DATA_NOT_FOUND
        );
    }

    public static function unProcess($message)
    {
        return response()->json(
            ["message" => $message],
            Message::UNPROCESS_STATUS
        );
    }
}
