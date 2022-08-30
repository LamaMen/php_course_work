<?php

namespace App\View\Components\Shared;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NotFound extends Component
{
    public int $page;
    public string $title;
    public string $description;

    public function __construct(int $page, string $title, string $description)
    {
        $this->page = $page ?? -1;
        $this->title = $title;
        $this->description = $description;
    }

    public function render(): View|Closure|string
    {
        return view('components.shared.not-found');
    }
}
