<?php

namespace App\Models\VewModels;

use App\Models\Domain\Excursion;
use App\Models\Domain\Group;
use DateTime;

class ExcursionGroup
{
    public Excursion $excursion;
    public Group $group;

    function __construct(Excursion $excursion,
                         Group     $group)
    {
        $this->excursion = $excursion;
        $this->group = $group;
    }

    public function date(): string
    {
        return date_format($this->group->dateTime, 'd.m H:i');
    }
}
