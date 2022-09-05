<?php

namespace App\View\Components\Shared;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CenterText extends Component
{
    public int $page;
    public string $title;

    public function __construct(string $title, int $page = -1)
    {
        $this->page = $page;
        $this->title = $title;
    }

    public function render(): View|Closure|string
    {
        return view('components.shared.center-text');
    }
}
