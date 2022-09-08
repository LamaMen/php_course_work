<?php

namespace App\Models\VewModels;

use App\Models\Domain\Excursion;

class ExcursionWithGroups
{
    public Excursion $excursion;
    public array $groups;

    function __construct(Excursion $excursion,
                         array     $groups)
    {
        $this->excursion = $excursion;
        $this->groups = $groups;
    }
}
