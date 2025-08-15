<?php

namespace App\Services;

use App\Repositories\Contract\GymRepositoryInterface;
use App\Repositories\Contract\CityRepositoryInterface;
use App\Repositories\Contract\SubscribePackageRepositoryInterface;


class FrontService
{
    protected $gymRepository;
    protected $cityRepository;
    protected $subscribePackageRepository;

    // dependency injection
    public function __construct(
        CityRepositoryInterface $cityRepository,
        GymRepositoryInterface $gymRepository,
        SubscribePackageRepositoryInterface $subscribePackageRepository
    ) {
    // Service ini menerima repository lewat constructor (DI).
    // Filosofi: service bertugas mengorkestrasi beberapa repository untuk
    // memenuhi kebutuhan use-case (business logic tingkat menengah).
    // Analogi: controller = "pelayan restoran", service = "koki" yang
    // meracik beberapa bahan (repository data) menjadi satu hidangan (response).
        $this->gymRepository = $gymRepository;
        $this->cityRepository = $cityRepository;
        $this->subscribePackageRepository = $subscribePackageRepository;
    }

    public function getFrontPageData()
    {
        $cities = $this->cityRepository->getAllCities();
        $popularGyms = $this->gymRepository->getPopularGyms(4);
        $newGyms = $this->gymRepository->getAllNewGyms();

        return compact('cities', 'popularGyms', 'newGyms');
    }

    public function getSubscriptionsData()
    {
        $subscribePackages = $this->subscribePackageRepository->getAllSubscribePackages();
        // The rest of the function is cut off in the image,
        // but it would typically return the data like this:
    // Kembalikan array yang sudah terstruktur untuk controller/serialisasi.
    return compact('subscribePackages');
    }
}
