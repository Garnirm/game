<?php

return [
    'population_classes' => [
        'worker' => [
            'housing_consumption' => 1,
            'upkeep' => [
                'food' => 2,
            ],
        ],
        'specialist' => [
            'housing_consumption' => 2,
            'upkeep' => [
                'food' => 4,
            ],
        ],
        'engineer' => [
            'housing_consumption' => 3,
            'upkeep' => [
                'food' => 6,
            ],
        ],
        'elite' => [
            'housing_consumption' => 4,
            'upkeep' => [
                'food' => 7,
            ],
        ],
    ],

    'jobs' => [
        'administrative_jobs' => [
            'pop_class' => 'specialist',
        ],
        'mayor' => [
            'pop_class' => 'elite',
            'production' => [ 'influence' => 10 ],
        ],
    ],

    'unlockable_tiles' => [
        'slow' => 50,
        'normal' => 100,
        'fast' => 200,
    ],
];