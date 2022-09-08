<?php

namespace App\View\Components\User;

use App\Repositories\PlaceRepository;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ExcursionsList extends Component
{
    public array $excursions;
    private int $instructorId;
    private PlaceRepository $placeRepository;

    public function __construct(PlaceRepository $placeRepository, int $instructorId)
    {
        $this->placeRepository = $placeRepository;
        $this->instructorId = $instructorId;
    }

    public function render(): View|string|Closure
    {
        $this->excursions = $this->placeRepository->getExcursionsByInstructor($this->instructorId);
        return view('components.user.excursions-list');
    }
}
