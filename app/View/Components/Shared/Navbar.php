<?php

namespace App\View\Components\Shared;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Navbar extends Component
{
    public array $routes = [
        ['name' => 'Главная', 'url' => '/'],
        ['name' => 'Популярные места', 'url' => '/places'],
        ['name' => 'Экскурсии', 'url' => '/excursions'],
    ];

    public int $current;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($current)
    {
        $this->current = $current;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render(): View|string|Closure
    {
        return view('components.shared.navbar');
    }
}
