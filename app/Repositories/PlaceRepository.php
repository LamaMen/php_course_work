<?php

namespace App\Repositories;

use App\Models\Domain\Excursion;
use App\Models\Domain\Place;
use App\Models\Domain\PlaceInfo;
use App\Models\Domain\Showplace;
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

    public function getPlaces(): array
    {
        $pdo = DB::connection()->getPdo();
        $query = $pdo->prepare("SELECT id, title, is_excursion(id) as is_excursion FROM PLACE");

        $query->execute();
        $places = $query->fetchAll();
        if (!$places) {
            return array();
        }

        return array_map(function ($place) {
            return PlaceInfo::fromDB($place);
        }, $places);
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
                    p.photo as photo
                    FROM SHOWPLACE s
                        INNER JOIN PLACE p on s.place_id = p.id
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
                    p.id as place_id,
                    p.title as title,
                    p.description as description,
                    e.address as address,
                    e.price as price,
                    e.duration as duration,
                    get_place_rating(p.id) as rating,
                    p.photo as photo
                    FROM EXCURSION e
                        INNER JOIN PLACE p on e.place_id = p.id
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

    public function getExcursionsByInstructor(int $instructorId): array
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
                    p.photo as photo
                    FROM EXCURSION e
                        INNER JOIN PLACE p on e.place_id = p.id
                        INNER JOIN EXCURSION_INSTRUCTOR i on e.id = i.excursion_id
                    WHERE i.instructor_id = :instructorId");

        $query->bindValue(':instructorId', $instructorId);
        $query->execute();
        $places = $query->fetchAll();

        if (!$places) {
            return array();
        }

        return array_map(function ($place) {
            return Excursion::fromDB($place);
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
                    p.photo as photo
                    FROM EXCURSION e
                        INNER JOIN PLACE p on e.place_id = p.id
                    WHERE e.id = :id");

        $query->bindValue(':id', $id);
        $query->execute();
        $place = $query->fetch();

        if (!$place) {
            return null;
        }

        return Excursion::fromDB($place);
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
                    p.photo as photo
                    FROM SHOWPLACE s
                        INNER JOIN PLACE p on s.place_id = p.id
                    WHERE s.id = :id");

        $query->bindValue(':id', $id);
        $query->execute();
        $place = $query->fetch();

        if (!$place) {
            return null;
        }

        return Showplace::fromDB($place);
    }

    public function getPlace(int $id): Place|null
    {
        $pdo = DB::connection()->getPdo();
        $query = $pdo->prepare(
            "SELECT is_excursion(id) as is_excursion
                    FROM PLACE
                    WHERE id = :id");

        $query->bindValue(':id', $id);
        $query->execute();
        $place = $query->fetch();

        if (!$place) {
            return null;
        }

        if ($place['is_excursion'] == 1) {
            $query = $pdo->prepare(
                "SELECT e.id as id,
                    p.id as place_id,
                    p.title as title,
                    p.description as description,
                    e.address as address,
                    e.price as price,
                    e.duration as duration,
                    get_place_rating(p.id) as rating,
                    p.photo as photo
                    FROM EXCURSION e
                        INNER JOIN PLACE p on e.place_id = p.id
                    WHERE p.id = :id");

            $query->bindValue(':id', $id);
            $query->execute();
            $place = $query->fetch();

            if (!$place) {
                return null;
            }

            return Excursion::fromDB($place);
        }


        $pdo = DB::connection()->getPdo();
        $query = $pdo->prepare(
            "SELECT s.id as id,
                    p.id as place_id,
                    p.title as title,
                    p.description as description,
                    s.address as address,
                    get_place_rating(p.id) as rating,
                    p.photo as photo
                    FROM SHOWPLACE s
                        INNER JOIN PLACE p on s.place_id = p.id
                    WHERE p.id = :id");

        $query->bindValue(':id', $id);
        $query->execute();
        $place = $query->fetch();

        if (!$place) {
            return null;
        }

        return Showplace::fromDB($place);
    }

    public function updateExcursion(int $id, array $permissions): void
    {
        $db = DB::connection()->getPdo();

        $query = $db->prepare(
            "DELETE FROM EXCURSION_INSTRUCTOR WHERE excursion_id = :excursion_id",
        );

        $query->bindValue(':excursion_id', $id);

        if (!$query->execute()) return;

        $query = $db->prepare(
            "INSERT INTO EXCURSION_INSTRUCTOR(instructor_id, excursion_id)
                        VALUES (:instructor_id, :excursion_id)"
        );
        $query->bindValue(':excursion_id', $id);

        foreach ($permissions as $permission) {
            $query->bindValue(':instructor_id', $permission);
            if (!$query->execute()) return;
        }
    }

    public function saveExcursion(Excursion $excursion): int|null
    {
        $db = DB::connection()->getPdo();

        if ($excursion->id == -1) {
            $query = $db->prepare(
                "INSERT INTO PLACE(title, description, photo)
                        VALUES (:title, :description, :photo)"
            );
        } else {
            $query = $db->prepare(
                "UPDATE PLACE
                SET title = :title, description = :description, photo = :photo
                WHERE id = :id "
            );
            $query->bindValue(':id', $excursion->placeId);
        }

        $query->bindValue(':title', $excursion->title);
        $query->bindValue(':description', $excursion->description);
        $query->bindValue(':photo', $excursion->photo);

        if (!$query->execute()) return null;

        if ($excursion->id == -1) {
            $id = $db->lastInsertId();
            $query = $db->prepare(
                "INSERT INTO EXCURSION(place_id, address, duration, price)
                        VALUES (:place_id, :address, :duration, :price)"
            );
            $query->bindValue(':place_id', $id);
        } else {
            $query = $db->prepare(
                "UPDATE EXCURSION
                SET address = :address, duration = :duration, price = :price
                WHERE id = :id"
            );
            $query->bindValue(':id', $excursion->id);
        }

        $query->bindValue(':address', $excursion->address);
        $query->bindValue(':duration', date_format($excursion->duration, 'H:i:s'));
        $query->bindValue(':price', $excursion->price);

        if (!$query->execute()) return null;
        return $excursion->id == -1 ? $db->lastInsertId() : $excursion->id;
    }

    public function saveShowplace(Showplace $showplace): void
    {
        $db = DB::connection()->getPdo();

        if ($showplace->id == -1) {
            $query = $db->prepare(
                "INSERT INTO PLACE(title, description, photo)
                        VALUES (:title, :description, :photo)"
            );
        } else {
            $query = $db->prepare(
                "UPDATE PLACE
                SET title = :title, description = :description, photo = :photo
                WHERE id = :id "
            );
            $query->bindValue(':id', $showplace->placeId);
        }

        $query->bindValue(':title', $showplace->title);
        $query->bindValue(':description', $showplace->description);
        $query->bindValue(':photo', $showplace->photo);

        if (!$query->execute()) return;

        if ($showplace->id == -1) {
            $id = $db->lastInsertId();
            $query = $db->prepare(
                "INSERT INTO SHOWPLACE(place_id, address)
                        VALUES (:place_id, :address)"
            );
            $query->bindValue(':place_id', $id);
        } else {
            $query = $db->prepare(
                "UPDATE SHOWPLACE
                SET address = :address
                WHERE id = :id"
            );
            $query->bindValue(':id', $showplace->id);
        }

        $query->bindValue(':address', $showplace->address);

        if (!$query->execute()) return;
    }

    private function getFromIndex(int $count, int $page): int
    {
        return ($page - 1) * $count;
    }
}
