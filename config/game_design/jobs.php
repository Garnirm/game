<?php

return [
    'administrative_job' => [
        'label' => 'Emploi administratif',
        'pop_class' => 'specialist',
        'production' => [
            'money' => 50,
        ],
    ],
    'beef_farmer' => [
        'label' => 'Eléveur de bovin',
        'pop_class' => 'worker',
    ],
    'beef_slaughterhouse_employee' => [
        'label' => 'Employé d\'abattoir bovin',
        'pop_class' => 'worker',
        'production' => [ 'beef_meat' => 8 ],
        'animals_consumption' => [ 'beef' => 1 ],
    ],
    'mayor' => [
        'label' => 'Maire',
        'pop_class' => 'elite',
        'production' => [ 'influence' => 10 ],
    ],
    'milk_worker' => [
        'label' => 'Ouvrier laitier',
        'pop_class' => 'worker',
        'cow_handling' => 20,
        'upkeep' => [
            'money' => 30,
        ],
    ],
    'military_high_graded' => [
        'label' => 'Haut-gradé',
        'pop_class' => 'elite',
        'upkeep' => [
            'money' => 1000,
        ],
    ],
    'military_officer' => [
        'label' => 'Officier',
        'pop_class' => 'specialist',
        'upkeep' => [
            'money' => 500,
        ],
    ],
    'military_soldier' => [
        'label' => 'Soldat',
        'pop_class' => 'worker',
        'upkeep' => [
            'money' => 250,
        ],
    ],
    'teacher' => [
        'label' => 'Professeur',
        'pop_class' => 'specialist',
        'child_capacity_teaching' => 20,
        'upkeep' => [
            'money' => 50,
        ],
    ],
    'wheat_farmer' => [
        'label' => 'Cultivateur de blé',
        'pop_class' => 'worker',
    ],
];