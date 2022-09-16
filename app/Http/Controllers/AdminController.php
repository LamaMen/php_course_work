<?php

namespace App\Http\Controllers;

use App\Models\Domain\Excursion;
use App\Models\Domain\Showplace;
use App\Repositories\GroupsRepository;
use App\Repositories\InstructorRepository;
use App\Repositories\PlaceRepository;
use App\Repositories\SpecializationsRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    private InstructorRepository $instructorRepository;
    private GroupsRepository $groupsRepository;
    private SpecializationsRepository $specializationsRepository;
    private PlaceRepository $placeRepository;

    function __construct(InstructorRepository $instructorRepository, GroupsRepository $groupsRepository, SpecializationsRepository $specializationsRepository, PlaceRepository $placeRepository)
    {
        $this->instructorRepository = $instructorRepository;
        $this->groupsRepository = $groupsRepository;
        $this->specializationsRepository = $specializationsRepository;
        $this->placeRepository = $placeRepository;
    }

    public function statistic(): View|RedirectResponse
    {
        $instructors = $this->instructorRepository->getAll();
        $instructorsNames = array_map(function ($instructor) {
            return $instructor->fullName();
        }, $instructors);

        $groupsEngaged = array_map(function ($instructor) {
            $groups = $this->groupsRepository->getGroupsByInstructor($instructor->instructorId);
            $sum = 0;
            foreach ($groups as $group) {
                $sum += $group->engaged;
            }
            return $sum;
        }, $instructors);

        $groups = $this->groupsRepository->getAllGroupsWithInstructors();

        return view('admin.admin', ['names' => $instructorsNames, 'values' => $groupsEngaged, 'groups' => $groups]);
    }

    public function specializations(): View|RedirectResponse
    {
        $specializations = $this->specializationsRepository->getSpecializations();
        return view('admin.specializations', ['specializations' => $specializations]);
    }

    public function createSpecialization(Request $request): RedirectResponse
    {
        $name = $request->input()['name'];
        $this->specializationsRepository->create($name);

        return redirect('/admin/specializations');
    }

    public function deleteSpecializations(Request $request): RedirectResponse
    {
        $inp = $request->input();

        if (!isset($inp['specializations'])) return redirect('/admin/specializations');

        $ids = $inp['specializations'];
        foreach ($ids as $id) {
            $this->specializationsRepository->delete($id);
        }

        return redirect('/admin/specializations');
    }

    public function excursions(): View|RedirectResponse
    {
        $places = $this->placeRepository->getPlaces();
        return view('admin.excursions', ['places' => $places]);
    }

    public function edit(int $id): View|RedirectResponse
    {
        $place = $this->placeRepository->getPlace($id);
        if ($place instanceof Excursion) {
            return view('admin.excursion', ['method' => 'Редактирование', 'excursion' => $place]);
        }

        return view('admin.showplace', ['method' => 'Редактирование', 'showplace' => $place]);
    }

    public function createExcursion(): View|RedirectResponse
    {
        $excursion = Excursion::empty();
        return view('admin.excursion', ['method' => 'Создание', 'excursion' => $excursion]);
    }

    public function createShowplace(): View|RedirectResponse
    {
        $showplace = Showplace::empty();
        return view('admin.showplace', ['method' => 'Создание', 'showplace' => $showplace]);
    }

    public function saveExcursion(Request $request): RedirectResponse
    {
        $inp = $request->input();
        $file = $request->file('photo');

        if ($file != null) {
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('images/places'), $filename);
            $path = '/images/places/' . $filename;
        } else if ($inp['id'] == -1) {
            $path = null;
        } else {
            $old = $this->placeRepository->getExcursion($inp['id']);
            $path = $old->photo;
        }

        $excursion = Excursion::fromForm($inp, $path);
        $this->placeRepository->saveExcursion($excursion);
        $this->placeRepository->updateExcursion($excursion->id, $inp['instructors']);

        return redirect('/admin/excursions');
    }

    public function saveShowplace(Request $request): RedirectResponse
    {
        $inp = $request->input();
        $file = $request->file('photo');

        if ($file != null) {
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('images/places'), $filename);
            $path = '/images/places/' . $filename;
        } else if ($inp['id'] == -1) {
            $path = null;
        } else {
            $old = $this->placeRepository->getShowplace($inp['id']);
            $path = $old->photo;
        }

        $showplace = Showplace::fromForm($inp, $path);
        $this->placeRepository->saveShowplace($showplace);

        return redirect('/admin/excursions');
    }
}
