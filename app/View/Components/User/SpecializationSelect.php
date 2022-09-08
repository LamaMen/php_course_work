<?php

namespace App\View\Components\User;

use App\Repositories\SpecializationsRepository;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SpecializationSelect extends Component
{
    public array $specializations;
    private SpecializationsRepository $repository;
    public int $specializationId;

    public function __construct(SpecializationsRepository $repository, int|null $specializationId)
    {
        $this->repository = $repository;
        $this->specializationId = $specializationId ?? -1;
    }

    public function render(): View|string|Closure
    {
        $this->specializations = $this->repository->getSpecializations();
        return view('components.user.specialization-select');
    }
}
