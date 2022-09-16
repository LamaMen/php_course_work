<?php

namespace App\Models\VewModels;

use App\Models\Domain\Excursion;
use App\Models\Domain\Group;
use DateTime;

class ExcursionGroup
{
    public Excursion $excursion;
    public DateTime $dateTime;

    function __construct(Excursion $excursion,
                         DateTime  $dateTime)
    {
        $this->excursion = $excursion;
        $this->dateTime = $dateTime;
    }

    public function date(): string
    {
        return date_format($this->dateTime, 'd.m H:i');
    }
}
