<?php

namespace App\Http\Controllers;

use App\Models\VewModels\PageWithItemsModel;
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
        $model = new PageWithItemsModel($excursions, $page, $maxPage);
        return view('excursions.list.excursions', ['model' => $model]);
    }

    public function excursion(int $id): View
    {
        $excursion = $this->repository->getExcursion($id);
        if ($excursion == null) {
            return view('excursions.item.excursion-not-found');
        }

        return view('excursions.item.excursion', ['excursion' => $excursion]);
    }
}
