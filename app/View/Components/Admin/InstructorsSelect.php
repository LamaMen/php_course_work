<?php

namespace App\View\Components\Admin;

use App\Repositories\InstructorRepository;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InstructorsSelect extends Component
{
    private InstructorRepository $instructorRepository;
    public array $instructors;
    public array $selectedInstructors;
    public int $place;

    public function __construct(InstructorRepository $instructorRepository, int $place = -1)
    {
        $this->place = $place;
        $this->instructorRepository = $instructorRepository;
    }

    public function render(): View|string|Closure
    {
        $this->instructors = $this->instructorRepository->getAll();
        $selectedInstructors = $this->instructorRepository->getByPlace($this->place);
        $this->selectedInstructors = array_map(function ($instructor) {
            return $instructor->instructorId;
        }, $selectedInstructors);

        return view('components.admin.instructors-select');
    }
}
