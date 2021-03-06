<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse;


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
        return $this->redirectBack($request->session());
    }

    public function singUp(Request $request): RedirectResponse
    {
        $user = User::fromForm($request->input());
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
        return $this->redirectBack($request->session());
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

    private function redirectBack(Session $session): RedirectResponse
    {
        if ($session->has('lastPath')) {
            $path = $session->get('lastPath');
            $session->remove('lastPath');
            return redirect($path);
        }

        return redirect()->route('home');
    }
}
