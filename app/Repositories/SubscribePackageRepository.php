<?php

namespace App\Repositories;

use App\Models\SubscribePackage;
use App\Repositories\Contract\SubscribePackageRepositoryInterface;

class SubscribePackageRepository implements SubscribePackageRepositoryInterface
{
    // Repository untuk paket langganan (SubscribePackage).
    // Memberikan akses read-only ke paket dan harga.
    public function getAllSubscribePackages()
    {
        return SubscribePackage::orderBy('id', 'asc')->get();
    }

    public function find($id)
    {
        return SubscribePackage::find($id);
    }

    public function getPrice($subscribePackageId)
    {
        $subscribePackage = $this->find($subscribePackageId);
        // Fallback harga 0 bila paket tidak ditemukan.
        return $subscribePackage ? $subscribePackage->price : 0;
    }
}
