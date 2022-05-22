<?php

namespace App\Http\Controllers;

use App\Repositories\PlaceRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    private PlaceRepository $repository;

    function __construct(PlaceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): View
    {
        $places = $this->repository->getPopularPlaces(3);
        $excursions = $this->repository->getPopularExcursions(1);
        return view('home.home', ['places' => $places, 'excursions' => $excursions]);
    }
}
