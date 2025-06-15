<?php

return [
    'resources' => [
        'concrete' => [ 'easy' => 4000000, 'normal' => 3000000, 'hard' => 2000000 ],
        'food' => [ 'easy' => 300000, 'normal' => 200000, 'hard' => 100000 ],
        'money' => [ 'easy' => 5000000, 'normal' => 2000000, 'hard' => 1000000 ],
        'steel' => [ 'easy' => 500000, 'normal' => 250000, 'hard' => 100000 ],
        'wood' => [ 'easy' => 50000, 'normal' => 25000, 'hard' => 10000 ],
    ],

    'buildings' => [
        [ 'name' => 'Hôtel de ville', 'type' => 'city_hall', 'tiles' => [ '0_0' ] ],
        [ 'name' => 'Immeuble', 'type' => 'apartments', 'tiles' => [ 'neg2_0', 'neg3_0' ] ],
    ],

    'roads' => [
        [ 'x' => 0, 'y' => -1, 'type' => 'horizontal_road', 'name' => 'Route' ],

        [ 'x' => -1, 'y' => -1, 'type' => 'intersection_road_bottom', 'name' => 'Intersection' ],
        [ 'x' => -1, 'y' => 0, 'type' => 'vertical_road', 'name' => 'Route' ],

        [ 'x' => -2, 'y' => -1, 'type' => 'horizontal_road', 'name' => 'Route' ],

        [ 'x' => -3, 'y' => -1, 'type' => 'horizontal_road', 'name' => 'Route' ],
    ],

    'tiles' => [
        [ 'name' => 'neg1_neg1', 'coord_x' => -1, 'coord_y' => -1, 'type' => 'building', 'biome' => 'plains' ],
        [ 'name' => 'neg1_0', 'coord_x' => -1, 'coord_y' => 0, 'type' => 'building', 'biome' => 'plains' ],

        [ 'name' => '0_neg1', 'coord_x' => 0, 'coord_y' => -1, 'type' => 'building', 'biome' => 'plains' ],
        [ 'name' => '0_0', 'coord_x' => 0, 'coord_y' => 0, 'type' => 'building', 'biome' => 'plains' ],

        [ 'name' => 'neg2_neg1', 'coord_x' => -2, 'coord_y' => -1, 'type' => 'building', 'biome' => 'plains' ],
        [ 'name' => 'neg2_0', 'coord_x' => -2, 'coord_y' => 0, 'type' => 'building', 'biome' => 'plains' ],

        [ 'name' => 'neg3_neg1', 'coord_x' => -3, 'coord_y' => -1, 'type' => 'building', 'biome' => 'plains' ],
        [ 'name' => 'neg3_0', 'coord_x' => -3, 'coord_y' => 0, 'type' => 'building', 'biome' => 'plains' ],
    ],
];