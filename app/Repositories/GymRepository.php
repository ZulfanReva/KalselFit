<?php

namespace App\Repositories;

use App\Models\Gym;
use App\Repositories\Contract\GymRepositoryInterface;

class GymRepository implements GymRepositoryInterface
{
    // Repository untuk Gym. Menyediakan query-ready methods yang digunakan service/controller.
    // Analogi: tempat-tempat yang sering dipakai (popular) diambil lewat method khusus.
    public function getPopularGyms()
    {
        return Gym::where('is_popular', true)->orderBy('name', 'asc')->get();
    }

    public function GetGyms()
    {
        return Gym::orderBy('name', 'asc')->get();
    }

    public function find($id)
    {
        return Gym::find($id);
    }

    public function getPrice($gymId)
    {
        $gym = $this->find($gymId);
        // Jika gym tidak ketemu, kembalikan 0 sebagai fallback harga.
        return $gym ? $gym->price : 0;
    }
}
