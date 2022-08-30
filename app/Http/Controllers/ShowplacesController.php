<?php

namespace App\Http\Controllers;

use App\Models\VewModels\PageWithItemsModel;
use App\Repositories\PlaceRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;

class ShowplacesController extends Controller
{
    private int $countOnPage = 12;
    private PlaceRepository $repository;

    function __construct(PlaceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function allShowplaces(int $page = 1): View|RedirectResponse
    {
        $maxPage = ceil($this->repository->getShowplacesCount() / $this->countOnPage);
        if ($page > $maxPage) {
            return redirect('/showplaces');
        }

        $showplaces = $this->repository->getShowplaces($this->countOnPage, $page);
        $model = new PageWithItemsModel($showplaces, $page, $maxPage);
        return view('showplaces.list.showplaces', ['model' => $model]);
    }


    public function showplace(int $id): View
    {
        $excursion = $this->repository->getShowplace($id);
        if ($excursion == null) {
            return view('showplaces.item.showplace-not-found');
        }

        return view('showplaces.item.showplace', ['showplace' => $excursion]);
    }
}
