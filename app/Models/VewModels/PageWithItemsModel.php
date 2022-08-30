<?php

namespace App\Models\VewModels;

class PageWithItemsModel
{
    public array $items;
    public int $actual;
    public int $count;

    function __construct(array $items,
                         int   $currentPage,
                         int   $maxPage)
    {

        $this->items = $items;
        $this->actual = $currentPage;
        $this->count = $maxPage;
    }
}
