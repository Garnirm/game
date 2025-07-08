<?php

return [
    'administrative_job' => [
        'label' => 'Emploi administratif',
        'pop_class' => 'specialist',
    ],
    'beef_farmer' => [
        'label' => 'Eléveur de bovin',
        'pop_class' => 'worker',
    ],
    'beef_slaughterhouse_employee' => [
        'label' => 'Employé d\'abattoir bovin',
        'pop_class' => 'worker',
        'production' => [ 'beef_meat' => 5 ],
        'animals_consumption' => [ 'beef' => 1 ],
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
];