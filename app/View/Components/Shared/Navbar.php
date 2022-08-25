<?php

namespace App\View\Components\Shared;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Navbar extends Component
{
    public int $current;
    public array $routes = [
        ['name' => 'Главная', 'url' => '/'],
        ['name' => 'Достопримечательности', 'url' => '/showplaces'],
        ['name' => 'Экскурсии', 'url' => '/excursions'],
    ];

    public function __construct($current)
    {
        $this->current = $current;
    }

    public function render(): View
    {
        return view('components.shared.navbar');
    }
}
