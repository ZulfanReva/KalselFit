<?php

namespace App\Repositories\Contract;

interface SubscribePackageRepositoryInterface
{
    // Kontrak untuk akses paket langganan. Memudahkan service mengambil daftar dan harga.
    public function getAllSubscribePackages();

    public function find($id);

    public function getPrice($subcribePackageId);

}
