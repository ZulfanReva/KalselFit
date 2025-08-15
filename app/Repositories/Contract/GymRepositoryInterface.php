<?php

namespace App\Repositories\Contract;

interface GymRepositoryInterface
{
    public function getPopularGyms ($limit);

    public function getAllNewGyms();

    public function find($id);

    public function getPrice($gymId);

}
