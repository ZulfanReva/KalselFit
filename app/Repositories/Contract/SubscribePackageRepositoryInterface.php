<?php

namespace App\Repositories\Contract;

interface SubscribePackageRepositoryInterface
{
    public function getAllSubscribePackages();

    public function find($id);

    public function getPrice($subcribePackageId);

}
