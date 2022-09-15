<?php

namespace App\View\Components\Places;

use App\Repositories\GroupsRepository;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BuyButton extends Component
{
    public int $excursionId;
    public array $groups;
    private GroupsRepository $groupsRepository;

    public function __construct(int $excursionId, GroupsRepository $groupsRepository)
    {
        $this->excursionId = $excursionId;
        $this->groupsRepository = $groupsRepository;
    }

    public function render(): View|string|Closure
    {
        $this->groups = $this->groupsRepository->getGroupsByExcursion($this->excursionId);
        return view('components.places.buy-button');
    }
}
