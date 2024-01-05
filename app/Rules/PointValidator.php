<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PointValidator implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!is_array($value)) {
            return false;
        }

        $arrayKey = ['type', 'coordinates'];
        $request = array_keys($value);

        if (count($arrayKey) != count($request) || array_diff($arrayKey, $request)) {
            return false;
        }
        // if point
        if ($value['type'] == "Point") {

            if (!is_array($value['coordinates']) || count($value['coordinates']) != 2) {
                return false;
            }
            if ($value['coordinates'][0] < -180 || $value['coordinates'][0] > 180) {
                return false;
            }
            if ($value['coordinates'][1] < -90 || $value['coordinates'][1] > 90) {
                return false;
            }
            //if polygon
        } elseif ($value['type'] == "Polygon") {
            if (!is_array($value['coordinates'])) {
                return false;
            }
            if (!is_array($value['coordinates'][0][0])) {
                return false;
            }
            foreach ($value['coordinates'][0] as $valuePoint) {

                if ($valuePoint[0] < -180 || $valuePoint[0] > 180) {
                    return false;
                }
                if ($valuePoint[1] < -90 || $valuePoint[1] > 90) {
                    return false;
                }
            }
            $first = reset($value['coordinates'][0]);
            $last = end($value['coordinates'][0]);
            if ($first[0] != $last[0] || $first[1] != $last[1]) {
                return false;
            }
            // if another point or polygon
        } else return false;
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('Invalid location');
    }
}
