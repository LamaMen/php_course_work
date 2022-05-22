<?php

namespace App\Repositories;

use App\Models\Excursion;
use App\Models\Place;
use DateTime;
use Illuminate\Support\Facades\DB;

class PlaceRepository
{
    function getPlacesCount(bool $isAll = false): int
    {
        $pdo = DB::connection()->getPdo();
        $query = $pdo->prepare(
            "SELECT Count(*) as count
                    FROM ORDINARY_PLACE
                    WHERE isArchive = :isAll");

        $query->bindValue(':isAll', $isAll);
        $query->execute();
        return $query->fetch()['count'];
    }

    function getExcursionsCount(bool $isAll = false): int
    {
        $pdo = DB::connection()->getPdo();
        $query = $pdo->prepare(
            "SELECT Count(*) as count
                    FROM EXCURSION e INNER JOIN PLACE p on e.id = p.id
                    WHERE isArchive = :isAll");

        $query->bindValue(':isAll', $isAll);
        $query->execute();
        return $query->fetch()['count'];
    }

    function getPopularPlaces(int $count, int $page = 1, bool $isAll = false): array
    {
        $pdo = DB::connection()->getPdo();
        $query = $pdo->prepare(
            "SELECT id, title, description, isArchive, rating
                    FROM ORDINARY_PLACE
                    WHERE isArchive = :isAll
                    ORDER BY rating DESC
                    LIMIT :from, :limit");

        $query->bindValue(':limit', $count);
        $query->bindValue(':from', $this->getFromIndex($count, $page));
        $query->bindValue(':isAll', $isAll);
        $query->execute();
        $places = $query->fetchAll();
        if (!$places) {
            return array();
        }

        return array_map(function ($place) {
            return Place::fromDB($place, ['photos' => $this->getPhotoByPlace($place['id'])]);
        }, $places);
    }

    public function getPopularExcursions(int $count, int $page = 1, bool $isAll = false): array
    {
        $pdo = DB::connection()->getPdo();
        $query = $pdo->prepare(
            "SELECT e.id as id,
                    p.title as title,
                    p.description as description,
                    e.destination as destination,
                    e.peopleNumber as peopleNumber,
                    p.isArchive as isArchive,
                    e.adultPrice as adultPrice,
                    e.duration as duration,
                    e.childPrice as childPrice,
                    get_place_rating(e.id) as rating
                    FROM EXCURSION e INNER JOIN PLACE p on e.id = p.id
                    WHERE isArchive = :isAll
                    ORDER BY rating DESC
                    LIMIT :from, :limit");

        $query->bindValue(':limit', $count);
        $query->bindValue(':from', $this->getFromIndex($count, $page));
        $query->bindValue(':isAll', $isAll);
        $query->execute();
        $places = $query->fetchAll();

        if (!$places) {
            return array();
        }

        return array_map(function ($place) use ($isAll) {
            return Excursion::fromDB($place, [
                'photos' => $this->getPhotoByPlace($place['id']),
                'dates' => $this->getExcursionDates($place['id'], $isAll),
            ]);
        }, $places);
    }

    private function getFromIndex(int $count, int $page): int
    {
        return ($page - 1) * $count;
    }

    private function getPhotoByPlace(int $id): array
    {
        $pdo = DB::connection()->getPdo();
        $query = $pdo->prepare("SELECT path FROM IMAGE WHERE placeId = :id");
        $query->bindValue(':id', $id);
        $query->execute();
        $photos = $query->fetchAll();

        if (!$photos) {
            return array();
        }

        return array_map(function ($r) {
            return $r['path'];
        }, $photos);
    }

    private function getExcursionDates(int $id, bool $isAll): array
    {
        $pdo = DB::connection()->getPdo();
        $query = $pdo->prepare("SELECT excursionDate
                                        FROM DATES
                                        WHERE excursionId = :id AND excursionDate > :date
                                        ORDER BY 1");
        $query->bindValue(':id', $id);
        if ($isAll) {
            $query->bindValue(':date', '0001-01-01 00:00:00');
        } else {
            $query->bindValue(':date', date("Y-m-d H:i:s"));
        }

        $query->execute();
        $photos = $query->fetchAll();

        if (!$photos) {
            return array();
        }

        return array_map(function ($r) {
            return DateTime::createFromFormat('Y-m-d H:i:s', $r['excursionDate']);
        }, $photos);
    }
}
