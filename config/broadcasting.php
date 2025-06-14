<?php

return [
    'default' => 'pusher',

    'connections' => [
        'pusher' => [
            'driver' => 'pusher',
            'key' => 'key',
            'secret' => 'secret',
            'app_id' => 'app_id',
            'options' => [
                'cluster' => null,
                'encrypted' => false,
                'host' => env('SOCKET_HOST', 'socket.gifrane.dra'),
                'port' => 6001,
                'scheme' => 'http',
            ],
        ],
    ],
];
