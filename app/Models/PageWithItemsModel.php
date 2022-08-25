<?php

namespace App\Models;

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
