<?php

namespace App\View\Components\Places;

use App\Repositories\CommentRepository;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CommentsList extends Component
{
    public array $comments;
    public int $placeId;
    private CommentRepository $commentRepository;

    public function __construct(int $placeId, CommentRepository $commentRepository)
    {
        $this->placeId = $placeId;
        $this->commentRepository = $commentRepository;
    }

    public function render(): View|Closure|string
    {
        $this->comments = $this->commentRepository->getCommentsByPlace($this->placeId);
        return view('components.places.comments-list');
    }
}
