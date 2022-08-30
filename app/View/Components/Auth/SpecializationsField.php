<?php

namespace App\View\Components\Auth;

use App\Repositories\SpecializationsRepository;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SpecializationsField extends Component
{
    public array $specializations;
    private SpecializationsRepository $repository;

    public function __construct(SpecializationsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function render(): View|string|Closure
    {
        $this->specializations = $this->repository->getSpecializations();
        return view('components.auth.specializations-field');
    }
}
