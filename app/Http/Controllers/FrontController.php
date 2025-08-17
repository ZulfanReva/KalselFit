<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Gym;
use Illuminate\Http\Request;
use App\Services\FrontService;

class FrontController extends Controller
{
    //
    protected $frontService;

    public function __construct(FrontService $frontService)
    {
        $this->frontService = $frontService;
    }

    public function index()
    {
        $data = $this->frontService->getFrontPageData();
        // dd($data);
        return view('front.index', $data);
    }

    public function pricing()
    {
        $data = $this->frontService->getSubscriptionsData();
        // dd($data);
        return view('front.pricing', $data);
    }

    public function details(Gym $gym)
    {
        // dd($gym);
        return view('front.details', compact('gym'));
    }

    public function city(City $city)
    {
        $data = $this->frontService->getFrontPageData();
        // dd($city);
        return view('front.city', $data, compact('city'));
    }

    public function cityAll(City $city)
    {
        // reuse front page data and explicitly pass all gyms for the city
        $data = $this->frontService->getFrontPageData();
        // eager load relationships if needed
        $city->load(['gyms.gymFacilities.facility', 'gyms.city']);
        return view('front.city', $data, compact('city'));
    }
}
