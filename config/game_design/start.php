<?php

return [
    'resources' => [
        'beef_meat' => [ 'easy' => 10000, 'normal' => 5000, 'hard' => 2500 ], // Viande de boeuf
        'concrete' => [ 'easy' => 4000000, 'normal' => 3000000, 'hard' => 2000000 ], // Béton
        'food' => [ 'easy' => 300000, 'normal' => 200000, 'hard' => 100000 ], // Nourriture
        'wheat' => [ 'easy' => 10000, 'normal' => 5000, 'hard' => 2500 ], // Blé
        'influence' => [ 'easy' => 100, 'normal' => 50, 'hard' => 20 ],
        'money' => [ 'easy' => 5000000, 'normal' => 2000000, 'hard' => 1000000 ],
        'steel' => [ 'easy' => 500000, 'normal' => 250000, 'hard' => 100000 ], // Acier
        'wood' => [ 'easy' => 50000, 'normal' => 25000, 'hard' => 10000 ], // Bois
    ],

    'buildings' => [
        [ 'name' => 'Hôtel de ville', 'type' => 'city_hall', 'tiles' => [ '0_0' ] ],
        [
            'name' => 'Immeuble', 'type' => 'apartments', 'id' => 'Immeuble 1', 'tiles' => [ 'neg2_0', 'neg3_0' ],
            'housing_repartition' => [
                'elite' => 1,
                'engineer' => 1,
                'specialist' => 5,
                'worker' => 33,
            ],
        ],
        [
            'name' => 'Corps de ferme', 'type' => 'farm_house', 'id' => 'Corps de ferme 1', 'tiles' => [ 'neg3_neg2' ],
            'housing_repartition' => [
                'worker' => 3,
            ],
        ],
        [ 'name' => 'Hangar de ferme pour véhicules', 'type' => 'vehicle_farm_shed', 'id' => 'Hangar de ferme pour véhicules 1', 'tiles' => [ 'neg3_neg3' ] ],
        [ 'name' => 'Champ de blé', 'type' => 'wheat_field', 'id' => 'Champ de blé 1', 'tiles' => [ 'neg2_neg2', 'neg2_neg3' ] ],
        [ 'name' => 'Exploitation bovine', 'type' => 'beef_farm', 'id' => 'Exploitation bovine 1', 'tiles' => [ 'neg4_neg2', 'neg4_neg3' ] ],
        [ 'name' => 'Abattoir bovin', 'type' => 'beef_slaughterhouse', 'id' => 'Abattoir bovin 1', 'tiles' => [ 'neg4_0' ] ],
    ],

    'pops' => [
        'neg2_0' => [
            'elite' => [
                'amount' => 1,
                'jobs' => [
                    [ 'job' => 'mayor', 'building_coordinates' => '0_0', 'amount' => 1 ],
                ],
            ],
            'specialist' => [
                'amount' => 5,
                'jobs' => [
                    [ 'job' => 'administrative_job', 'building_coordinates' => '0_0', 'amount' => 5 ],
                ],
            ],
            'worker' => [
                'amount' => 25,
                'jobs' => [
                    [ 'job' => 'wheat_farmer', 'building_coordinates' => '-2_-2', 'amount' => 1 ],
                    [ 'job' => 'beef_farmer', 'building_coordinates' => '-4_-2', 'amount' => 2 ],
                    [ 'job' => 'beef_slaughterhouse_employee', 'building_coordinates' => '-4_0', 'amount' => 10 ],
                ],
            ],
        ],

        'neg3_neg2' => [
            'worker' => [
                'amount' => 3,
                'jobs' => [
                    [ 'job' => 'wheat_farmer', 'building_coordinates' => '-2_-2', 'amount' => 3 ],
                ],
            ],
        ],
    ],

    'roads' => [
        [ 'x' => 0, 'y' => -1, 'type' => 'horizontal_road', 'name' => 'Route' ],

        [ 'x' => -1, 'y' => -1, 'type' => 'intersection_road_bottom', 'name' => 'Intersection' ],
        [ 'x' => -1, 'y' => 0, 'type' => 'vertical_road', 'name' => 'Route' ],

        [ 'x' => -2, 'y' => -1, 'type' => 'horizontal_road', 'name' => 'Route' ],

        [ 'x' => -3, 'y' => -1, 'type' => 'horizontal_road', 'name' => 'Route' ],

        [ 'x' => -4, 'y' => -1, 'type' => 'horizontal_road', 'name' => 'Route' ],

        [ 'x' => -5, 'y' => -1, 'type' => 'horizontal_road', 'name' => 'Route' ],
    ],

    'tiles' => [
        [ 'name' => 'neg1_neg1', 'coord_x' => -1, 'coord_y' => -1, 'type' => 'building', 'biome' => 'plains' ],
        [ 'name' => 'neg1_0', 'coord_x' => -1, 'coord_y' => 0, 'type' => 'building', 'biome' => 'plains' ],

        [ 'name' => '0_neg1', 'coord_x' => 0, 'coord_y' => -1, 'type' => 'building', 'biome' => 'plains' ],
        [ 'name' => '0_0', 'coord_x' => 0, 'coord_y' => 0, 'type' => 'building', 'biome' => 'plains' ],

        [ 'name' => 'neg2_neg3', 'coord_x' => -2, 'coord_y' => -3, 'type' => 'building', 'biome' => 'plains' ],
        [ 'name' => 'neg2_neg2', 'coord_x' => -2, 'coord_y' => -2, 'type' => 'building', 'biome' => 'plains' ],
        [ 'name' => 'neg2_neg1', 'coord_x' => -2, 'coord_y' => -1, 'type' => 'building', 'biome' => 'plains' ],
        [ 'name' => 'neg2_0', 'coord_x' => -2, 'coord_y' => 0, 'type' => 'building', 'biome' => 'plains' ],

        [ 'name' => 'neg3_neg3', 'coord_x' => -3, 'coord_y' => -3, 'type' => 'building', 'biome' => 'plains' ],
        [ 'name' => 'neg3_neg2', 'coord_x' => -3, 'coord_y' => -2, 'type' => 'building', 'biome' => 'plains' ],
        [ 'name' => 'neg3_neg1', 'coord_x' => -3, 'coord_y' => -1, 'type' => 'building', 'biome' => 'plains' ],
        [ 'name' => 'neg3_0', 'coord_x' => -3, 'coord_y' => 0, 'type' => 'building', 'biome' => 'plains' ],

        [ 'name' => 'neg4_neg3', 'coord_x' => -4, 'coord_y' => -3, 'type' => 'building', 'biome' => 'plains' ],
        [ 'name' => 'neg4_neg2', 'coord_x' => -4, 'coord_y' => -2, 'type' => 'building', 'biome' => 'plains' ],
        [ 'name' => 'neg4_neg1', 'coord_x' => -4, 'coord_y' => -1, 'type' => 'building', 'biome' => 'plains' ],
        [ 'name' => 'neg4_0', 'coord_x' => -4, 'coord_y' => 0, 'type' => 'building', 'biome' => 'plains' ],

        [ 'name' => 'neg5_neg1', 'coord_x' => -5, 'coord_y' => -1, 'type' => 'building', 'biome' => 'plains' ],
    ],
];