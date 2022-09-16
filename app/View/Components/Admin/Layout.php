<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Layout extends Component
{
    public int $current;
    public string $title;

    public array $routes = [
        ['title' => 'Статистика по группам', 'icon' => 'home', 'url' => '/admin'],
        ['title' => 'Специализации', 'icon' => 'users', 'url' => '/admin/specializations'],
        ['title' => 'Экскурсии', 'icon' => 'map', 'url' => '/admin/excursions'],
    ];


    public function __construct(string|null $title = null, int $current = 0)
    {
        $this->current = $current;
        $this->title = $title != null ? $title : $this->routes[$this->current]['title'];
    }

    public function render(): View|string|Closure
    {
        return view('components.admin.layout');
    }
}
