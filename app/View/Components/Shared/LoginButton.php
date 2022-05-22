<?php

namespace App\View\Components\Shared;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Psr\Container\ContainerExceptionInterface;

class LoginButton extends Component
{
    public User|null $user;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|View
     * @throws ContainerExceptionInterface
     */
    public function render(): View|Factory|Application
    {
        $this->user = session()->has('user') ? session()->get('user') : null;
        return view('components.shared.login-button');
    }
}
