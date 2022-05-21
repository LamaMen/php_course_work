<?php

namespace App\Repositories;

use App\Models\Excursion;
use App\Models\Place;
use Illuminate\Support\Facades\DB;

class PlaceRepository
{
    function getPopularPlaces(int $count): array
    {
        $pdo = DB::connection()->getPdo();
        $query = $pdo->prepare(
            "SELECT id, title, description, rating
                    FROM ORDINARY_PLACE ORDER BY rating DESC LIMIT :limit");
        $query->bindValue(':limit', $count);
        $query->execute();
        $places = $query->fetchAll();

        if (!$places) {
            return array();
        }

        return array_map(function ($place) {
            return Place::fromDB($place, $this->getPhotoByPlace($place['id']));
        }, $places);
    }

    public function getPopularExcursions(int $count): array
    {
        $pdo = DB::connection()->getPdo();
        $query = $pdo->prepare(
            "SELECT e.id, p.title, p.description, e.excursionDate,
                    e.destination, e.peopleNumber, e.price, get_place_rating(e.id) as rating
                    FROM EXCURSION e INNER JOIN PLACE p on e.id = p.id ORDER BY rating DESC LIMIT :limit");

        $query->bindValue(':limit', $count);
        $query->execute();
        $places = $query->fetchAll();

        if (!$places) {
            return array();
        }

        return array_map(function ($place) {
            return Excursion::fromDB($place, $this->getPhotoByPlace($place['id']));
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

        return array_map(function ($p) {
            return $p['path'];
        }, $photos);
    }
}
