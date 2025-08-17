<?php

namespace App\Repositories;

use App\Models\Gym;
use App\Repositories\Contract\GymRepositoryInterface;

class GymRepository implements GymRepositoryInterface
{
    // Repository untuk Gym. Menyediakan query-ready methods yang digunakan service/controller.
    // Analogi: tempat-tempat yang sering dipakai (popular) diambil lewat method khusus.
    public function getPopularGyms($limit = 4)
    {
        return Gym::where('is_popular', true)->take($limit)->get();
    }

    public function getAllNewGyms()
    {
        return Gym::latest()->get();
    }

    public function getAllPopularGyms()
    {
        return Gym::where('is_popular', true)->get();
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
