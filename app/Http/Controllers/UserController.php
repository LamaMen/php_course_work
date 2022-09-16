<?php

namespace App\Http\Controllers;

use App\Models\Domain\Instructor;
use App\Models\Domain\User;
use App\Repositories\InstructorRepository;
use App\Repositories\OrdersRepository;
use App\Repositories\UserRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cookie;

class UserController extends Controller
{
    private UserRepository $userRepository;
    private InstructorRepository $instructorRepository;
    private OrdersRepository $ordersRepository;

    function __construct(UserRepository $userRepository, InstructorRepository $instructorRepository, OrdersRepository $ordersRepository)
    {
        $this->userRepository = $userRepository;
        $this->instructorRepository = $instructorRepository;
        $this->ordersRepository = $ordersRepository;
    }

    public function user(int $id): View|RedirectResponse
    {
        $user = $this->userRepository->getById($id);
        if ($user == null || $user->role == 'admin') {
            return view('profile.not-found');
        }

        if ($user->role == 'instructor') {
            $instructor = $this->instructorRepository->getById($user->id);
            return view('profile.instructor', ['instructor' => $instructor]);
        }

        $excursions = $this->ordersRepository->getExcursionsUniq($user->id);
        return view('profile.user', ['user' => $user, 'excursions' => $excursions]);
    }

    public function edit(int $id): View|RedirectResponse
    {
        $user = $this->userRepository->getById($id);
        if ($user == null) {
            return view('profile.not-found');
        }

        if ($user->id != Cookie::get('user_id')) {
            return view('other.not-permitted');
        }

        if ($user->role == 'instructor') {
            $instructor = $this->instructorRepository->getById($user->id);
            return view('profile.edit.instructor', ['instructor' => $instructor]);
        }

        return view('profile.edit.user', ['user' => $user]);
    }

    public function applyChanges(Request $request): View|RedirectResponse
    {
        $inp = $request->input();
        $file = $request->file('photo');

        if ($file != null) {
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('images/users'), $filename);
            $path = '/images/users/' . $filename;
        } else {
            $user = session()->get('user');
            $path = $user->photo;
        }

        $user = $inp['role'] == 'instructor' ? Instructor::fromForm($inp, $path) : User::fromForm($inp, $path);
        $this->userRepository->update($user);
        session()->remove('user');
        session()->put('user', $user);
        return redirect('/user/' . $user->id);
    }
}
