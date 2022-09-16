<?php

namespace App\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Layout extends Component
{
    public int $pageIndex;
    public string $title;

    public function __construct(string $title, int $pageIndex = -1)
    {
        $this->pageIndex = $pageIndex;
        $this->title = $title;
    }

    public function render(): View|Factory|Application
    {
        return view('components.layout');
    }
}
