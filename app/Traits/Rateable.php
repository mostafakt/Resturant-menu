<?php

namespace App\Traits;

use App\Models\Rate;

trait Rateable
{
    public function rates()
    {
        return $this->morphMany(Rate::class, 'rateable');
    }

    public function rateForUser()
    {
        return $this->rates()->where('user_id', auth()?->id() ?? null);
    }

    public function averageRating()
    {
        return $this->rates()->avg('value');
    }
}
