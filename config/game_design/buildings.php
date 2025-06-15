<?php

return [
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
        'base_production' => [],

        'base_jobs' => [
            'administrative_job' => 5,
            'mayor' => 1,
        ],

        'base_upkeep' => [
            'money' => 1000,
        ],

        'base_cost' => [
            'money' => 35000,
            'wood' => 1500,
            'concrete' => 15000,
        ],
    ],

    'horizontal_road' => [
        'base_floor' => 0,
        'base_jobs' => [],
        'base_production' => [],

        'base_upkeep' => [
            'money' => 80,
            'concrete' => 4,
        ],

        'base_cost' => [
            'money' => 500,
            'concrete' => 200,
        ],
    ],

    'intersection_road_bottom' => [
        'base_floor' => 0,
        'base_jobs' => [],
        'base_production' => [],

        'base_upkeep' => [
            'money' => 110,
            'concrete' => 7,
        ],

        'base_cost' => [
            'money' => 700,
            'concrete' => 250,
        ],
    ],

    'vertical_road' => [
        'base_floor' => 0,
        'base_jobs' => [],
        'base_production' => [],

        'base_upkeep' => [
            'money' => 80,
            'concrete' => 4,
        ],

        'base_cost' => [
            'money' => 500,
            'concrete' => 200,
        ],
    ],
];