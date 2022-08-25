<?php

namespace App\View\Components\Shared;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PagesNav extends Component
{
    public int $actual;
    public int $count;

    public function __construct(int $actual,
                                int $count)
    {
        $this->actual = $actual;
        $this->count = $count;
    }

    public function render(): View
    {
        return view('components.shared.pages-nav');
    }
}
