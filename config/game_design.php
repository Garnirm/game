<?php

return [
    'population_classes' => [
        'worker' => [
            'housing_consumption' => 1,
        ],
        'specialist' => [
            'housing_consumption' => 2,
        ],
        'engineer' => [
            'housing_consumption' => 3,
        ],
        'elite' => [
            'housing_consumption' => 4,
        ],
    ],

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
        'wood' => [
            'easy' => 50000,
            'normal' => 25000,
            'hard' => 10000,
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

            'base_cost' => [
                'money' => 15000,
                'wood' => 500,
                'concrete' => 2000,
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

            'base_cost' => [
                'money' => 35000,
                'wood' => 1500,
                'concrete' => 15000,
            ],
        ],

        'vertical_road' => [
            'base_floor' => 0,
            'base_jobs' => [],
            'base_production' => [],

            'base_upkeep' => [
                'money' => 80,
            ],

            'base_cost' => [
                'money' => 500,
                'concrete' => 200,
            ],
        ]
    ],
];