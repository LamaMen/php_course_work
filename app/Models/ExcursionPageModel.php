<?php

namespace App\Models;

class ExcursionPageModel
{
    public array $excursions;
    public int $currentPage;
    public int $maxPage;

    function __construct(array    $excursions,
                         int $currentPage,
                         int $maxPage)
    {

        $this->excursions = $excursions;
        $this->currentPage = $currentPage;
        $this->maxPage = $maxPage;
    }
}
