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

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(int $pageIndex, string $title)
    {
        $this->pageIndex = $pageIndex;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|View
     */
    public function render(): View|Factory|Application
    {
        return view('components.layout');
    }
}
