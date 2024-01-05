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

if (!function_exists('distanceInMeter')) {
    function distanceInMeter(string $origin, string $destination, string $way_points = null)
    {
        //example
//        $origin = '40.7128,-74.0060'; // New York City, New York, USA
//        $destination = '34.0522,-118.2437'; // Los Angeles, California, USA
//        $way_points = '41.8781,-87.6298|32.7767,-96.7970';

        if ($way_points) {
            $response = Http::get('https://maps.googleapis.com/maps/api/directions/json', [
                'origin' => $origin,
                'destination' => $destination,
                'waypoints' => $way_points,
                'key' => 'AIzaSyD_Ecf6AfcAlfySC6sNrSfadK1lBWZpsow',
            ]);
        } else {
            $response = Http::get('https://maps.googleapis.com/maps/api/directions/json', [
                'origin' => $origin,
                'destination' => $destination,
                'key' => 'AIzaSyD_Ecf6AfcAlfySC6sNrSfadK1lBWZpsow',
            ]);
        }


        // Check for a successful response
        if ($response->successful()) {

            $data = $response->json();

            if ($data['status'] === 'OK') {
                return $data['routes'][0]['legs'][0]['distance']['value'];
            }
            log::error("Failed to fetch directions, status of api is : " . $data['status']);
        } else {
            log::error("Failed to fetch directions");
        }
        //todo get distance from line view
        return 0;
    }
}

if (!function_exists('distanceInKM')) {
    function distanceInKM(string $origin, string $destination, string $way_points = null)
    {
        return distanceInMeter($origin, $destination, $way_points) / 1000;
    }
}


