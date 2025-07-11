<?php

return [
    'resources' => [
        'beef_meat' => [ 'easy' => 10000, 'normal' => 5000, 'hard' => 2500 ], // Viande de boeuf
        'concrete' => [ 'easy' => 4000000, 'normal' => 3000000, 'hard' => 2000000 ], // Béton
        'food' => [ 'easy' => 300000, 'normal' => 200000, 'hard' => 100000 ], // Nourriture
        'wheat' => [ 'easy' => 10000, 'normal' => 5000, 'hard' => 2500 ], // Blé
        'milk' => [ 'easy' => 10000, 'normal' => 5000, 'hard' => 2500 ], // Lait
        'cheese' => [ 'easy' => 10000, 'normal' => 5000, 'hard' => 2500 ], // Fromage
        'influence' => [ 'easy' => 100, 'normal' => 50, 'hard' => 20 ],
        'money' => [ 'easy' => 5000000, 'normal' => 2000000, 'hard' => 1000000 ],
        'steel' => [ 'easy' => 500000, 'normal' => 250000, 'hard' => 100000 ], // Acier
        'wood' => [ 'easy' => 50000, 'normal' => 25000, 'hard' => 10000 ], // Bois
    ],

    'animals' => [
        [ 'animal' => 'cow', 'amount' => 40, 'building_coordinates' => '-4_-2' ],
        [ 'animal' => 'beef', 'amount' => 40, 'building_coordinates' => '-4_-2' ],
    ],

    'buildings' => [
        [ 'name' => 'Hôtel de ville', 'type' => 'city_hall', 'tiles' => [ '0_0' ] ],
        [
            'name' => 'Immeuble', 'type' => 'apartments', 'id' => 'Immeuble 1', 'tiles' => [ 'neg2_0', 'neg2_1', 'neg3_0', 'neg3_1' ],
            'housing_repartition' => [
                'elite' => 1,
                'engineer' => 1,
                'specialist' => 5,
                'worker' => 25,
                'child' => 10,
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
        [ 'name' => 'Ecole', 'type' => 'school', 'id' => 'Ecole 1', 'tiles' => [ '0_1' ] ],
        [ 'name' => 'Usine laitière', 'type' => 'milk_factory', 'id' => 'Usine laitière 1', 'tiles' => [ 'neg5_neg2' ] ],
        [
            'name' => 'Baraquements mixtes', 'type' => 'military_mixed_barracks', 'id' => 'Baraquements mixtes 1', 'tiles' => [ '0_2' ],
            'housing_repartition' => [
                'elite' => 5,
                'specialist' => 5,
                'worker' => 20,
            ],
        ],
        [ 'name' => 'Armurerie', 'type' => 'military_armory', 'id' => 'Armurerie 1', 'tiles' => [ '0_3' ] ],
    ],

    'pops' => [
        'neg3_neg2' => [
            'worker' => [
                'amount' => 3,
                'jobs' => [
                    [ 'job' => 'wheat_farmer', 'building_coordinates' => '-2_-2', 'amount' => 3 ],
                ],
            ],
        ],

        'neg2_0' => [
            'elite' => [
                'amount' => 1,
                'jobs' => [
                    [ 'job' => 'mayor', 'building_coordinates' => '0_0', 'amount' => 1 ],
                ],
            ],
            'specialist' => [
                'amount' => 8,
                'jobs' => [
                    [ 'job' => 'administrative_job', 'building_coordinates' => '0_0', 'amount' => 5 ],
                    [ 'job' => 'teacher', 'building_coordinates' => '0_1', 'amount' => 3 ],
                ],
            ],
            'worker' => [
                'amount' => 25,
                'jobs' => [
                    [ 'job' => 'wheat_farmer', 'building_coordinates' => '-2_-2', 'amount' => 1 ],
                    [ 'job' => 'beef_farmer', 'building_coordinates' => '-4_-2', 'amount' => 2 ],
                    [ 'job' => 'beef_slaughterhouse_employee', 'building_coordinates' => '-4_0', 'amount' => 10 ],
                    [ 'job' => 'milk_worker', 'building_coordinates' => '-5_-2', 'amount' => 2 ],
                ],
            ],
            'child' => [
                'amount' => 10,
            ],
        ],

        '0_2' => [
            'elite' => [
                'amount' => 5,
                'jobs' => [
                    [ 'job' => 'military_high_graded', 'building_coordinates' => '0_2', 'amount' => 5 ],
                ],
            ],
            'specialist' => [
                'amount' => 5,
                'jobs' => [
                    [ 'job' => 'military_officer', 'building_coordinates' => '0_2', 'amount' => 5 ],
                ],
            ],
            'worker' => [
                'amount' => 20,
                'jobs' => [
                    [ 'job' => 'military_soldier', 'building_coordinates' => '0_2', 'amount' => 20 ],
                ],
            ],
        ],
    ],

    'roads' => [
        [ 'x' => 0, 'y' => -1, 'type' => 'horizontal_road', 'name' => 'Route' ],

        [ 'x' => -1, 'y' => -1, 'type' => 'intersection_road_bottom', 'name' => 'Intersection' ],
        [ 'x' => -1, 'y' => 0, 'type' => 'vertical_road', 'name' => 'Route' ],
        [ 'x' => -1, 'y' => 1, 'type' => 'vertical_road', 'name' => 'Route' ],
        [ 'x' => -1, 'y' => 2, 'type' => 'vertical_road', 'name' => 'Route' ],
        [ 'x' => -1, 'y' => 3, 'type' => 'vertical_road', 'name' => 'Route' ],

        [ 'x' => -2, 'y' => -1, 'type' => 'horizontal_road', 'name' => 'Route' ],

        [ 'x' => -3, 'y' => -1, 'type' => 'horizontal_road', 'name' => 'Route' ],

        [ 'x' => -4, 'y' => -1, 'type' => 'horizontal_road', 'name' => 'Route' ],

        [ 'x' => -5, 'y' => -1, 'type' => 'horizontal_road', 'name' => 'Route' ],
    ],

    'tiles' => [
        [ 'name' => 'neg1_neg1', 'coord_x' => -1, 'coord_y' => -1, 'type' => 'road', 'biome' => 'plains' ],
        [ 'name' => 'neg1_0', 'coord_x' => -1, 'coord_y' => 0, 'type' => 'road', 'biome' => 'plains' ],
        [ 'name' => 'neg1_1', 'coord_x' => -1, 'coord_y' => 1, 'type' => 'road', 'biome' => 'plains' ],
        [ 'name' => 'neg1_2', 'coord_x' => -1, 'coord_y' => 2, 'type' => 'road', 'biome' => 'plains' ],
        [ 'name' => 'neg1_3', 'coord_x' => -1, 'coord_y' => 3, 'type' => 'road', 'biome' => 'plains' ],

        [ 'name' => '0_neg1', 'coord_x' => 0, 'coord_y' => -1, 'type' => 'road', 'biome' => 'plains' ],
        [ 'name' => '0_0', 'coord_x' => 0, 'coord_y' => 0, 'type' => 'building', 'biome' => 'plains' ],
        [ 'name' => '0_1', 'coord_x' => 0, 'coord_y' => 1, 'type' => 'building', 'biome' => 'plains' ],
        [ 'name' => '0_2', 'coord_x' => 0, 'coord_y' => 2, 'type' => 'military_base', 'biome' => 'plains' ],
        [ 'name' => '0_3', 'coord_x' => 0, 'coord_y' => 3, 'type' => 'military_base', 'biome' => 'plains' ],

        [ 'name' => 'neg2_neg3', 'coord_x' => -2, 'coord_y' => -3, 'type' => 'building', 'biome' => 'plains' ],
        [ 'name' => 'neg2_neg2', 'coord_x' => -2, 'coord_y' => -2, 'type' => 'building', 'biome' => 'plains' ],
        [ 'name' => 'neg2_neg1', 'coord_x' => -2, 'coord_y' => -1, 'type' => 'road', 'biome' => 'plains' ],
        [ 'name' => 'neg2_0', 'coord_x' => -2, 'coord_y' => 0, 'type' => 'building', 'biome' => 'plains' ],
        [ 'name' => 'neg2_1', 'coord_x' => -2, 'coord_y' => 1, 'type' => 'building', 'biome' => 'plains' ],

        [ 'name' => 'neg3_neg3', 'coord_x' => -3, 'coord_y' => -3, 'type' => 'building', 'biome' => 'plains' ],
        [ 'name' => 'neg3_neg2', 'coord_x' => -3, 'coord_y' => -2, 'type' => 'building', 'biome' => 'plains' ],
        [ 'name' => 'neg3_neg1', 'coord_x' => -3, 'coord_y' => -1, 'type' => 'road', 'biome' => 'plains' ],
        [ 'name' => 'neg3_0', 'coord_x' => -3, 'coord_y' => 0, 'type' => 'building', 'biome' => 'plains' ],
        [ 'name' => 'neg3_1', 'coord_x' => -3, 'coord_y' => 1, 'type' => 'building', 'biome' => 'plains' ],

        [ 'name' => 'neg4_neg3', 'coord_x' => -4, 'coord_y' => -3, 'type' => 'building', 'biome' => 'plains' ],
        [ 'name' => 'neg4_neg2', 'coord_x' => -4, 'coord_y' => -2, 'type' => 'building', 'biome' => 'plains' ],
        [ 'name' => 'neg4_neg1', 'coord_x' => -4, 'coord_y' => -1, 'type' => 'road', 'biome' => 'plains' ],
        [ 'name' => 'neg4_0', 'coord_x' => -4, 'coord_y' => 0, 'type' => 'building', 'biome' => 'plains' ],

        [ 'name' => 'neg5_neg2', 'coord_x' => -5, 'coord_y' => -2, 'type' => 'building', 'biome' => 'plains' ],
        [ 'name' => 'neg5_neg1', 'coord_x' => -5, 'coord_y' => -1, 'type' => 'road', 'biome' => 'plains' ],
    ],
];