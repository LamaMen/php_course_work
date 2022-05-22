<?php

namespace App\Http\Controllers;

use App\Models\ExcursionPageModel;
use App\Repositories\PlaceRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;

class ExcursionController extends Controller
{
    private int $countOnPage = 12;
    private PlaceRepository $repository;

    function __construct(PlaceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function allExcursions(int $page = 1): View|RedirectResponse
    {
        $maxPage = ceil($this->repository->getExcursionsCount() / $this->countOnPage);
        if ($page > $maxPage) {
            return redirect('/excursions');
        }

        $excursions = $this->repository->getPopularExcursions($this->countOnPage, $page);
        $model = new ExcursionPageModel($excursions, $page, $maxPage);
        return view('excursions.excursions', ['model' => $model]);
    }
}
