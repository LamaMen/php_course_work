<?php

namespace App\Repositories;

use App\Models\Domain\Excursion;
use App\Models\Domain\Group;
use App\Models\VewModels\ExcursionGroup;
use DateTime;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class OrdersRepository
{
    public function create(int $groupId): void
    {
        $db = DB::connection()->getPdo();
        $query = $db->prepare(
            "INSERT INTO EXCURSION_ORDER(user_id, group_id)
            VALUES (:userId, :group_id)"
        );
        $query->bindValue(':userId', Cookie::get('user_id'));
        $query->bindValue(':group_id', $groupId);
        $query->execute();
    }

    public function getExcursions(int $userId): array
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
                    p.photo as photo,
                    g.e_date as date
                    FROM
                        EXCURSION_ORDER o
                            INNER JOIN  EXCURSION_GROUP g on o.group_id = g.id
                            INNER JOIN EXCURSION_INSTRUCTOR i on g.instructor_id = i.id
                            INNER JOIN EXCURSION e on i.excursion_id = e.id
                            INNER JOIN PLACE p on e.place_id = p.id
                    WHERE o.user_id = :user_id");

        $query->bindValue(':user_id', $userId);
        $query->execute();
        $places = $query->fetchAll();

        if (!$places) {
            return array();
        }

        return array_map(function ($place) {
            $excursion = Excursion::fromDB($place);
            $date = DateTime::createFromFormat('Y-m-d H:i:s', $place['date']);
            return new ExcursionGroup($excursion, $date);
        }, $places);
    }

    public function getExcursionsUniq(int $userId): array
    {
        $pdo = DB::connection()->getPdo();
        $query = $pdo->prepare(
            "SELECT DISTINCT e.id as id,
                    p.id as place_id,
                    p.title as title,
                    p.description as description,
                    e.address as address,
                    e.price as price,
                    e.duration as duration,
                    get_place_rating(p.id) as rating,
                    p.photo as photo
                    FROM
                        EXCURSION_ORDER o
                            INNER JOIN  EXCURSION_GROUP g on o.group_id = g.id
                            INNER JOIN EXCURSION_INSTRUCTOR i on g.instructor_id = i.id
                            INNER JOIN EXCURSION e on i.excursion_id = e.id
                            INNER JOIN PLACE p on e.place_id = p.id
                    WHERE o.user_id = :user_id");

        $query->bindValue(':user_id', $userId);
        $query->execute();
        $places = $query->fetchAll();

        if (!$places) {
            return array();
        }

        return array_map(function ($place) {
            return Excursion::fromDB($place);
        }, $places);
    }
}
