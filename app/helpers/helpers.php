<?php

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

if (!function_exists('point2string')) {
    function point2string(\MatanYadaev\EloquentSpatial\Objects\Point $point)
    {
        return $point->latitude . ',' . $point->longitude;
    }
}

if (!function_exists('points2string')) {
    function points2string(\Illuminate\Support\Collection $points)
    {
        $pointAsString = [];
        foreach ($points as $point) {
            $pointAsString[] = point2string($point);
        }

        return implode("|", $pointAsString);
    }
}


