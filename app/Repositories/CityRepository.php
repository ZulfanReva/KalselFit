<?php

namespace App\Repositories;

use App\Models\City;
use App\Repositories\Contract\CityRepositoryInterface;

class CityRepository implements CityRepositoryInterface
{
    public function getAllCities()
    {
        return City::latest()->get();
    }
}
