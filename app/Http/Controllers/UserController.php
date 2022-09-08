<?php

namespace App\Http\Controllers;

use App\Models\Domain\Instructor;
use App\Models\Domain\User;
use App\Repositories\InstructorRepository;
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

    function __construct(UserRepository $userRepository, InstructorRepository $instructorRepository)
    {
        $this->userRepository = $userRepository;
        $this->instructorRepository = $instructorRepository;
    }

    public function user(int $id): View|RedirectResponse
    {
        $user = $this->userRepository->getById($id);
        if ($user == null) {

            return view('profile.not-found');
        }

        if ($user->role == 'instructor') {
            $instructor = $this->instructorRepository->getById($user->id);
            return view('profile.instructor', ['instructor' => $instructor]);
        }

        return view('profile.user', ['user' => $user]);
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
            // For Prod, KOSTILLLL
            // substr(public_path(''), 0, -12) . '/public_html/images/users'
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
