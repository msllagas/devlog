<?php

namespace App\Core;
class Validator
{


    public static function string($value, $min = 1, $max = INF)
    {
        $value = trim($value);
        $length = mb_strlen($value);

        return $length >= $min && $length <= $max;
    }

}