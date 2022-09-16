<?php

namespace App\Http\Controllers;

use App\Repositories\GroupsRepository;
use App\Repositories\InstructorRepository;
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

    function __construct(InstructorRepository $instructorRepository, GroupsRepository $groupsRepository, SpecializationsRepository $specializationsRepository)
    {
        $this->instructorRepository = $instructorRepository;
        $this->groupsRepository = $groupsRepository;
        $this->specializationsRepository = $specializationsRepository;
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
}
