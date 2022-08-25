<?php

namespace App\Repositories;

use App\Models\Excursion;
use App\Models\Showplace;
use Illuminate\Support\Facades\DB;

class PlaceRepository
{
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
            "SELECT p.id as id,
                    p.title as title,
                    p.description as description,
                    get_place_rating(p.id) as rating,
                    s.address as address,
                    i.photo as photo
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
            return Showplace::fromDB($place);
        }, $places);
    }

    public function getPopularExcursions(int $count, int $page = 1): array
    {
        $pdo = DB::connection()->getPdo();
        $query = $pdo->prepare(
            "SELECT e.id as id,
                    p.title as title,
                    p.description as description,
                    e.address as address,
                    e.price as price,
                    e.duration as duration,
                    get_place_rating(p.id) as rating,
                    i.photo as photo
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
            return Excursion::fromDB($place);
        }, $places);
    }

    private function getFromIndex(int $count, int $page): int
    {
        return ($page - 1) * $count;
    }
}
