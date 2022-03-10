<?php

namespace Bitsika\Resources\Supports;

final class HttpMethod
{
    const GET = 'GET';
    const POST = 'POST';
    const PUT = 'PUT';
    const PATCH = 'PATCH';
    const DELETE = 'DELETE';

    public static function all()
    {
        return [
            self::GET, self::POST, self::PUT, 
            self::PATCH, self::DELETE
        ];
    }
}