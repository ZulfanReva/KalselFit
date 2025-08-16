<?php

namespace App\Repositories;

use App\Models\City;
use App\Repositories\Contract\CityRepositoryInterface;

class CityRepository implements CityRepositoryInterface
{
    // Simple repository untuk entitas City.
    // Filosofi: jangan letakkan query Eloquent di controller. Taruh di repository agar mudah diuji.
    public function getAllCities()
    {
        return City::orderBy('name', 'asc')->get();
    }
}
