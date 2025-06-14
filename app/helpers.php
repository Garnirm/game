<?php

use Illuminate\Support\Facades\Log;

function getUserIp(): string
{
    $keys = [
        'HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR',
    ];

    foreach ($keys as $k) {
        if (isset($_SERVER[ $k ])) {
            return $_SERVER[ $k ];
        }
    }

    return '';
}

function log_user_error(array $params): void
{
    Log::channel('user_error')->info(json_encode($params));
}