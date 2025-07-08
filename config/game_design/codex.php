<?php

return [
    'population_classes' => [
        'worker' => [
            'housing_consumption' => 1,
            'upkeep' => [
                'food' => 2,
                'wheat' => 1,
                'beef_meat' => 1,
            ],
        ],
        'specialist' => [
            'housing_consumption' => 2,
            'upkeep' => [
                'food' => 4,
                'wheat' => 2,
                'beef_meat' => 2,
            ],
        ],
        'engineer' => [
            'housing_consumption' => 3,
            'upkeep' => [
                'food' => 6,
                'wheat' => 4,
                'beef_meat' => 4,
            ],
        ],
        'elite' => [
            'housing_consumption' => 4,
            'upkeep' => [
                'food' => 7,
                'wheat' => 6,
                'beef_meat' => 6,
            ],
        ],
    ],

    'unlockable_tiles' => [ 'slow' => 30, 'normal' => 50, 'fast' => 100 ],
];