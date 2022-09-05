<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class InstructorRequired
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        try {
            $user = session()->get('user');
            if ($user->role != 'instructor') {
                return redirect()->route('not-permitted');
            }
            return $next($request);
        } catch (NotFoundExceptionInterface|ContainerExceptionInterface) {
            return redirect('sing_in');
        }
    }
}
