<?php

namespace App\View\Components\Places;

use App\Repositories\InstructorRepository;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InstructorsList extends Component
{
    public int $placeId;
    public array $instructors;
    private InstructorRepository $instructorRepository;

    public function __construct(InstructorRepository $instructorRepository, int $placeId)
    {
        $this->instructorRepository = $instructorRepository;
        $this->placeId = $placeId;
    }

    public function render(): View|Closure|string
    {
        $this->instructors = $this->instructorRepository->getByPlace($this->placeId);
        return view('components.places.instructors-list');
    }
}
