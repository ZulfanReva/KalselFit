<?php

namespace App\Repositories\Contract;

interface GymRepositoryInterface
{
    // Kontrak untuk repository Gym. Menyediakan method yang dibutuhkan layer service.
    public function getPopularGyms($limit);

    public function getAllNewGyms();

    public function getAllPopularGyms();

    public function find($id);

    public function getPrice($gymId);
}
