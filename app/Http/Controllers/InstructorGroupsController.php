<?php

namespace App\Http\Controllers;

use App\Models\Domain\Group;
use App\Models\VewModels\ExcursionWithGroups;
use App\Repositories\GroupsRepository;
use App\Repositories\InstructorRepository;
use App\Repositories\PlaceRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cookie;

class InstructorGroupsController extends Controller
{
    private PlaceRepository $placeRepository;
    private GroupsRepository $groupsRepository;
    private InstructorRepository $instructorRepository;


    function __construct(PlaceRepository $placeRepository, GroupsRepository $groupsRepository, InstructorRepository $instructorRepository)
    {
        $this->placeRepository = $placeRepository;
        $this->groupsRepository = $groupsRepository;
        $this->instructorRepository = $instructorRepository;
    }

    public function groups(): Factory|View|Application
    {
        $instructor = $this->instructorRepository->getById(Cookie::get('user_id'));
        $excursions = $this->placeRepository->getExcursionsByInstructor($instructor->instructorId);
        $groups = $this->groupsRepository->getGroupsByInstructor($instructor->instructorId);
        $model = array_map(function ($excursion) use ($groups) {
            $groupsByExcursion = array_filter($groups, function ($group) use ($excursion) {
                return $excursion->id == $group->excursionId;
            });

            return new ExcursionWithGroups($excursion, $groupsByExcursion);
        }, $excursions);


        return view('groups.groups', ['excursions' => $model]);
    }

    public function create(Request $request): RedirectResponse
    {
        $form = $request->input();
        $instructor = $this->instructorRepository->getById(Cookie::get('user_id'));
        $group = Group::fromForm($form, $instructor->instructorId);
        $this->groupsRepository->save($group);

        return redirect('/groups');
    }
}
