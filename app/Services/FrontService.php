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
        return compact('subscribePackages');
    }
}
