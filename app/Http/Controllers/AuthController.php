<?php

namespace App\Http\Controllers;

use App\Models\Domain\Instructor;
use App\Models\Domain\User;
use App\Repositories\UserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class AuthController extends Controller
{
    private UserRepository $repository;

    function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function singIn(Request $request): RedirectResponse
    {
        $inp = $request->input();
        $user = $this->repository->getByEmail($inp['email']);
        if ($user == null) {
            return back()->withErrors(['email' => 'Yes']);
        }

        if ($inp['password'] != $user->password) {
            return back()->withErrors(['password' => 'Yes'])
                ->withInput();
        }

        $request->session()->regenerate();
        $request->session()->put('user', $user);
        return $this->redirectBack();
    }

    public function singUp(Request $request): RedirectResponse
    {
        $inp = $request->input();
        $user = $inp['role'] == 'instructor' ? Instructor::fromForm($inp) : User::fromForm($inp);

        if (!$user->validatePassword()) {
            return back()->withErrors(['password' => 'true'])
                ->withInput();
        }

        $userWithId = $this->repository->save($user);
        if ($userWithId == null) {
            return back()->withErrors(['email' => 'true'])
                ->withInput();
        }

        $request->session()->regenerate();
        $request->session()->put('user', $userWithId);
        return $this->redirectBack();
    }

    public function logout(Request $request): RedirectResponse
    {
        $session = $request->session();
        if ($session->has('user')) {
            $session->remove('user');
            $session->regenerate();
        }

        return redirect()->route('home');
    }

    private function redirectBack(): RedirectResponse
    {
        $session = session();
        if ($session->has('user')) {
            $user = $session->get('user');
            if ($user->role == 'admin') {
                return redirect()->route('admin');
            }
        }

        if ($session->has('lastPath')) {
            $path = $session->get('lastPath');
            $session->remove('lastPath');
            return redirect($path);
        }

        return redirect()->route('home');
    }
}
