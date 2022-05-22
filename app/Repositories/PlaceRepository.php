<?php

namespace App\Repositories;

use App\Models\Excursion;
use App\Models\Place;
use DateTime;
use Illuminate\Support\Facades\DB;

class PlaceRepository
{
    function getPopularPlaces(int $count): array
    {
        $pdo = DB::connection()->getPdo();
        $query = $pdo->prepare(
            "SELECT id, title, description, isArchive, rating
                    FROM ORDINARY_PLACE
                    WHERE isArchive = FALSE
                    ORDER BY rating
                    DESC LIMIT :limit");
        $query->bindValue(':limit', $count);
        $query->execute();
        $places = $query->fetchAll();
        if (!$places) {
            return array();
        }

        return array_map(function ($place) {
            return Place::fromDB($place, ['photos' => $this->getPhotoByPlace($place['id'])]);
        }, $places);
    }

    public function getPopularExcursions(int $count): array
    {
        // TODO - should return only active excursion
        $pdo = DB::connection()->getPdo();
        $query = $pdo->prepare(
            "SELECT e.id as id,
                    p.title as title,
                    p.description as description,
                    e.destination as destination,
                    e.peopleNumber as peopleNumber,
                    p.isArchive as isArchive,
                    e.price as price,
                    get_place_rating(e.id) as rating
                    FROM EXCURSION e INNER JOIN PLACE p on e.id = p.id
                    WHERE isArchive = FALSE
                    ORDER BY rating DESC
                    LIMIT :limit");

        $query->bindValue(':limit', $count);
        $query->execute();
        $places = $query->fetchAll();

        if (!$places) {
            return array();
        }

        return array_map(function ($place) {
            return Excursion::fromDB($place, [
                'photos' => $this->getPhotoByPlace($place['id']),
                'dates' => $this->getExcursionDates($place['id']),
            ]);
        }, $places);
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

    private function getExcursionDates(int $id): array
    {
        $pdo = DB::connection()->getPdo();
        $query = $pdo->prepare("SELECT excursionDate FROM DATES WHERE excursionId = :id ORDER BY 1");
        $query->bindValue(':id', $id);
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
