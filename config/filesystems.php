<?php

return [
    'default' => env('FILESYSTEM_DRIVER', 'local'),

    'disks' => [
        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],
    ],

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

    's3_directories' => [
        'projects' => env('S3_PROJECTS_DIRECTORY'),
    ],
];
