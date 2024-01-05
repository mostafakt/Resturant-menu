<?php

namespace App\Http\Services;

use App\Http\Services\Base\CrudService;
use App\Models\Area;
use App\Models\City;
use App\Models\Driver;
use App\Models\Investor;
use App\Models\Store;
use App\Models\User;
use MatanYadaev\EloquentSpatial\Objects\Point;

class UserService extends CrudService
{
    protected function getModelClass(): string
    {
        return User::class;
    }

    public function setRoles(User $user, $roles)
    {
        if ($roles) {
            $user->assignRole($roles);
        }
    }

    public function getInvestorsInCity(Point $location)
    {
        $city = City::query()->whereHas('areas', function ($query) use ($location) {
            $query->containsPoint($location);
        })->first();

        $stores = Store::query()->where('city_id', $city->id)->with('investors.user')->get();
        return $stores->pluck('investors.*.user')->flatten();
    }

    public function getInvestorsInArea(Point $location)
    {
        $area = Area::query()->containsPoint($location)->first();

        $stores = Store::query()
            ->whereWithin('location', $area->points)
            ->with('investors.user')
            ->get();
        return $stores->pluck('investors.*.user')->flatten();
    }

    public function getDrivers()
    {
        return Driver::query()->with('user')->get()->pluck('user');
    }
}
