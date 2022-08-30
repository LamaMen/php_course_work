<?php

namespace App\View\Components\Shared;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Divider extends Component
{
    public function render(): View|string|Closure
    {
        return view('components.shared.divider');
    }
}
