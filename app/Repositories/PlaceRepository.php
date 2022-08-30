<?php

namespace App\Repositories;

use App\Models\Domain\Excursion;
use App\Models\Domain\Showplace;
use Illuminate\Support\Facades\DB;

class PlaceRepository
{
    private UserRepository $repository;

    function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getShowplacesCount(): int
    {
        $pdo = DB::connection()->getPdo();
        $query = $pdo->prepare(
            "SELECT Count(*) as count
                    FROM SHOWPLACE");

        $query->execute();
        return $query->fetch()['count'];
    }

    public function getExcursionsCount(): int
    {
        $pdo = DB::connection()->getPdo();
        $query = $pdo->prepare(
            "SELECT Count(*) as count
                    FROM EXCURSION e");

        $query->execute();
        return $query->fetch()['count'];
    }

    public function getShowplaces(int $count, int $page = 1): array
    {
        $pdo = DB::connection()->getPdo();
        $query = $pdo->prepare(
            "SELECT s.id as id,
                    p.id as place_id,
                    p.title as title,
                    p.description as description,
                    get_place_rating(p.id) as rating,
                    s.address as address,
                    i.photo as photo,
                    p.owner_id as owner_id
                    FROM SHOWPLACE s
                        INNER JOIN PLACE p on s.place_id = p.id
                        INNER JOIN PLACE_IMAGE i on p.id = i.place_id
                    ORDER BY rating DESC
                    LIMIT :from, :limit");

        $query->bindValue(':limit', $count);
        $query->bindValue(':from', $this->getFromIndex($count, $page));
        $query->execute();
        $places = $query->fetchAll();
        if (!$places) {
            return array();
        }

        return array_map(function ($place) {
            $owner = $this->repository->getById($place['owner_id']);
            return Showplace::fromDB($place, $owner);
        }, $places);
    }

    public function getPopularExcursions(int $count, int $page = 1): array
    {
        $pdo = DB::connection()->getPdo();
        $query = $pdo->prepare(
            "SELECT e.id as id,
                    p.id as place_id,
                    p.title as title,
                    p.description as description,
                    e.address as address,
                    e.price as price,
                    e.duration as duration,
                    get_place_rating(p.id) as rating,
                    i.photo as photo,
                    p.owner_id as owner_id
                    FROM EXCURSION e
                        INNER JOIN PLACE p on e.place_id = p.id
                        LEFT JOIN PLACE_IMAGE i on p.id = i.place_id
                    ORDER BY rating DESC
                    LIMIT :from, :limit");

        $query->bindValue(':limit', $count);
        $query->bindValue(':from', $this->getFromIndex($count, $page));
        $query->execute();
        $places = $query->fetchAll();

        if (!$places) {
            return array();
        }

        return array_map(function ($place) {
            $owner = $this->repository->getById($place['owner_id']);
            return Excursion::fromDB($place, $owner);
        }, $places);
    }

    public function getExcursion(int $id): Excursion|null
    {
        $pdo = DB::connection()->getPdo();
        $query = $pdo->prepare(
            "SELECT e.id as id,
                    p.id as place_id,
                    p.title as title,
                    p.description as description,
                    e.address as address,
                    e.price as price,
                    e.duration as duration,
                    get_place_rating(p.id) as rating,
                    i.photo as photo,
                    p.owner_id as owner_id
                    FROM EXCURSION e
                        INNER JOIN PLACE p on e.place_id = p.id
                        LEFT JOIN PLACE_IMAGE i on p.id = i.place_id
                    WHERE e.id = :id");

        $query->bindValue(':id', $id);
        $query->execute();
        $place = $query->fetch();

        if (!$place) {
            return null;
        }

        $owner = $this->repository->getById($place['owner_id']);
        return Excursion::fromDB($place, $owner);
    }

    public function getShowplace(int $id): Showplace|null
    {
        $pdo = DB::connection()->getPdo();
        $query = $pdo->prepare(
            "SELECT s.id as id,
                    p.id as place_id,
                    p.title as title,
                    p.description as description,
                    s.address as address,
                    get_place_rating(p.id) as rating,
                    i.photo as photo,
                    p.owner_id as owner_id
                    FROM SHOWPLACE s
                        INNER JOIN PLACE p on s.place_id = p.id
                        LEFT JOIN PLACE_IMAGE i on p.id = i.place_id
                    WHERE s.id = :id");

        $query->bindValue(':id', $id);
        $query->execute();
        $place = $query->fetch();

        if (!$place) {
            return null;
        }

        $owner = $this->repository->getById($place['owner_id']);
        return Showplace::fromDB($place, $owner);
    }

    private function getFromIndex(int $count, int $page): int
    {
        return ($page - 1) * $count;
    }
}
