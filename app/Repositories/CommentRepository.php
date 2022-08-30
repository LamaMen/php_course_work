<?php

namespace App\Repositories;

use App\Models\Domain\Comment;
use Illuminate\Support\Facades\DB;
use PDOException;

class CommentRepository
{
    private UserRepository $repository;
    private PlaceRepository $placeRepository;

    function __construct(UserRepository $repository, PlaceRepository $placeRepository)
    {
        $this->repository = $repository;
        $this->placeRepository = $placeRepository;
    }

    public function getCommentsByPlace(int $placeId, bool $isNeedPlace = false): array
    {
        $pdo = DB::connection()->getPdo();
        $query = $pdo->prepare("SELECT * FROM COMMENT WHERE place_id = :id");

        $query->bindValue(':id', $placeId);
        $query->execute();
        $comments = $query->fetchAll();

        if (!$comments) {
            return array();
        }

        return array_map(function ($comment) use ($isNeedPlace) {
            $owner = $this->repository->getById($comment['user_id']);
            $place = null;
            if ($isNeedPlace) {
                $place = $this->placeRepository->getExcursion($comment['place_id']);
            }

            return Comment::fromDB($comment, $owner, $place);
        }, $comments);
    }

    public function create(Comment $comment): void
    {
        try {
            $db = DB::connection()->getPdo();
            $query = $db->prepare(
                "INSERT INTO COMMENT(user_id, place_id, comment_text, rating)
                        VALUES (:user_id, :place_id, :comment_text, :rating)"
            );
            $query->bindValue(':user_id', $comment->user->id);
            $query->bindValue(':place_id', $comment->place->placeId);
            $query->bindValue(':comment_text', $comment->text);
            $query->bindValue(':rating', $comment->rating);

            if (!$query->execute()) return;

        } catch (PDOException $e) {
            return;
        }
    }
}
