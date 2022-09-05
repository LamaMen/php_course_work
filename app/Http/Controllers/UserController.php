<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    private UserRepository $repository;

    function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function user(int $id): View|RedirectResponse
    {
        $user = $this->repository->getById($id);
        if ($user == null) {
            return view('profile.not-found');
        }

        if ($user->role == 'instructor') {
            return view('profile.instructor', ['instructor' => $user]);
        }

        return view('profile.user', ['user' => $user]);
    }
}
