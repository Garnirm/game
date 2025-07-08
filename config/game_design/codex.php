<?php

return [
    'population_classes' => [
        'worker' => [
            'housing_consumption' => 1,
            'upkeep' => [
                'food' => 2,
                'wheat' => 1,
                'beef_meat' => 2,
            ],
        ],
        'specialist' => [
            'housing_consumption' => 2,
            'upkeep' => [
                'food' => 4,
                'wheat' => 2,
                'beef_meat' => 4,
            ],
        ],
        'engineer' => [
            'housing_consumption' => 3,
            'upkeep' => [
                'food' => 6,
                'wheat' => 4,
                'beef_meat' => 6,
            ],
        ],
        'elite' => [
            'housing_consumption' => 4,
            'upkeep' => [
                'food' => 7,
                'wheat' => 6,
                'beef_meat' => 7,
            ],
        ],
    ],

    'jobs' => [
        'administrative_job' => [
            'label' => 'Emploi administratif',
            'pop_class' => 'specialist',
        ],
        'beef_farmer' => [
            'label' => 'Eléveur de bovin',
            'pop_class' => 'worker',
        ],
        'mayor' => [
            'label' => 'Maire',
            'pop_class' => 'elite',
            'production' => [ 'influence' => 10 ],
        ],
        'wheat_farmer' => [
            'label' => 'Cultivateur de blé',
            'pop_class' => 'worker',
        ],
    ],

    'unlockable_tiles' => [ 'slow' => 30, 'normal' => 50, 'fast' => 100 ],
];