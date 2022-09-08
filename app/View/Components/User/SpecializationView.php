<?php

namespace App\View\Components\User;

use App\Repositories\CommentRepository;
use App\Repositories\SpecializationsRepository;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SpecializationView extends Component
{
    private SpecializationsRepository $specializationsRepository;
    public string $name;
    public int $id;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(SpecializationsRepository $specializationsRepository, int $id)
    {
        $this->id = $id;
        $this->specializationsRepository = $specializationsRepository;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render(): View|string|Closure
    {
        $specialization = $this->specializationsRepository->getSpecializationById($this->id);
        $this->name = $specialization->name;

        return view('components.user.specialization-view');
    }
}
