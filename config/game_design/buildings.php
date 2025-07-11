<?php

return [
    'apartments' => [
        'base_floor' => 4,
        'base_housing' => 25,

        'base_upkeep' => [
            'money' => 100,
        ],

        'base_cost' => [
            'money' => 15000,
            'wood' => 500,
            'concrete' => 2000,
        ],
    ],

    'beef_farm' => [
        'base_floor' => 0,

        'base_capacity_animals' => [
            'beef' => 40,
            'cow' => 40,
        ],

        'base_jobs' => [
            'beef_farmer' => 1,
        ],

        'base_upkeep' => [
            'money' => 60,
            'wheat' => 5,
        ],

        'base_cost' => [
            'money' => 500,
            'wood' => 20,
        ],
    ],

    'beef_slaughterhouse' => [
        'base_floor' => 1,

        'base_jobs' => [
            'beef_slaughterhouse_employee' => 10,
        ],

        'base_upkeep' => [
            'money' => 200,
        ],

        'base_cost' => [
            'money' => 25000,
            'concrete' => 1000,
            'steel' => 600,
        ],
    ],

    'city_hall' => [
        'base_floor' => 2,

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

    'farm_house' => [
        'base_floor' => 1,
        'base_housing' => 3,

        'base_upkeep' => [
            'money' => 50,
        ],

        'base_cost' => [
            'money' => 8000,
            'wood' => 400,
            'concrete' => 1000,
        ],
    ],

    'horizontal_road' => [
        'base_floor' => 0,

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

        'base_upkeep' => [
            'money' => 110,
            'concrete' => 7,
        ],

        'base_cost' => [
            'money' => 700,
            'concrete' => 250,
        ],
    ],

    'milk_factory' => [
        'base_floor' => 0,

        'base_upkeep' => [
            'money' => 500,
        ],

        'base_cost' => [
            'money' => 10000,
            'steel' => 1000
        ],

        'base_jobs' => [
            'milk_worker' => 10,
        ],
    ],

    'school' => [
        'base_floor' => 2,

        'base_upkeep' => [
            'money' => 1200,
        ],

        'base_cost' => [
            'money' => 40000,
            'concrete' => 20000,
            'steel' => 2000,
        ],

        'base_jobs' => [
            'teacher' => 5,
        ],
    ],

    'vehicle_farm_shed' => [
        'base_floor' => 0,
        'base_capacity_vehicle' => 4,

        'base_upkeep' => [
            'money' => 40,
        ],

        'base_cost' => [
            'money' => 5000,
            'steel' => 100,
        ],
    ],

    'vertical_road' => [
        'base_floor' => 0,

        'base_upkeep' => [
            'money' => 80,
            'concrete' => 4,
        ],

        'base_cost' => [
            'money' => 500,
            'concrete' => 200,
        ],
    ],

    'wheat_field' => [
        'base_floor' => 0,

        'base_jobs' => [
            'wheat_farmer' => 2,
        ],

        'base_production' => [
            'wheat' => 50,
        ],

        'base_upkeep' => [
            'money' => 50,
        ],

        'base_cost' => [
            'money' => 1000,
        ],
    ],
];