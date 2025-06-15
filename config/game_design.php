<?php

return [
    'start_resources' => [
        'concrete' => [
            'easy' => 4000000,
            'normal' => 3000000,
            'hard' => 2000000,
        ],
        'food' => [
            'easy' => 300000,
            'normal' => 200000,
            'hard' => 100000,
        ],
        'money' => [
            'easy' => 5000000,
            'normal' => 2000000,
            'hard' => 1000000,
        ],
        'steel' => [
            'easy' => 500000,
            'normal' => 250000,
            'hard' => 100000,
        ],
    ],

    'unlockable_tiles' => [
        'slow' => 50,
        'normal' => 100,
        'fast' => 200,
    ],

    'buildings' => [
        'apartments' => [
            'base_floor' => 3,
            'base_housing' => 25,

            'base_jobs' => [],
            'base_production' => [],

            'base_upkeep' => [
                'money' => 100,
            ],
        ],

        'city_hall' => [
            'base_floor' => 2,

            'base_jobs' => [
                'administrative_job' => 5,
            ],

            'base_upkeep' => [
                'money' => 1000,
            ],

            'base_production' => [
                'influence' => 10,
            ],
        ],

        'vertical_road' => [
            'base_floor' => 0,
            'base_jobs' => [],
            'base_production' => [],

            'base_upkeep' => [
                'money' => 80,
            ],
        ]
    ],
];