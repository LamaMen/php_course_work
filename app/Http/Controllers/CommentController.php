<?php

namespace App\Http\Controllers;

use App\Models\Domain\Comment;
use App\Repositories\CommentRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class CommentController extends Controller
{
    private CommentRepository $repository;

    function __construct(CommentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function create(Request $request): RedirectResponse
    {
        $inp = $request->input();
        $user = session()->get('user');
        $comment = Comment::fromForm($inp, $user);
        $this->repository->create($comment);
        return back();
    }
}
