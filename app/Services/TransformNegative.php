<?php

namespace App\Services;

class TransformNegative
{
    public static function castToRealNumber(string $number): int
    {
        if (str_starts_with($number, 'neg')) {
            $number = (int) str_replace('neg', '', $number);
            $number = -$number;
            
            return $number;
        }

        return (int) $number;
    }
}