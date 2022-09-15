<?php

namespace App\Repositories;

use App\Models\Domain\Group;
use App\Models\VewModels\GroupWithInstructor;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class GroupsRepository
{
    private InstructorRepository $instructorRepository;

    function __construct(InstructorRepository $instructorRepository)
    {
        $this->instructorRepository = $instructorRepository;
    }

    public function getGroupsByInstructor(int $instructorId): array
    {
        $pdo = DB::connection()->getPdo();
        $query = $pdo->prepare(
            "SELECT *
                    FROM GROUPS_INFO g
                    WHERE instructor_id = :instructor_id
                    ORDER BY date");

        $query->bindValue(':instructor_id', $instructorId);
        $query->execute();
        $groups = $query->fetchAll();
        if (!$groups) {
            return array();
        }

        return array_map(function ($group) {
            return Group::fromDB($group);
        }, $groups);
    }

    public function getGroupsByExcursion(int $excursionId): array
    {
        $pdo = DB::connection()->getPdo();
        $query = $pdo->prepare(
            "SELECT *
                    FROM GROUPS_INFO
                    WHERE excursion_id = :excursion_id
                      AND date > NOW()
                      AND users < capacity
                      AND id not in (SELECT group_id FROM EXCURSION_ORDER WHERE user_id = :user_id)
                    ORDER BY date");

        $query->bindValue(':excursion_id', $excursionId);
        $query->bindValue(':user_id', Cookie::get('user_id'));

        $query->execute();
        $groups = $query->fetchAll();
        if (!$groups) {
            return array();
        }

        return array_map(function ($groupDto) {
            $group = Group::fromDB($groupDto);
            $instructor = $this->instructorRepository->getByNativeId($group->instructorId);
            return new GroupWithInstructor($group, $instructor);
        }, $groups);
    }

    public function save(Group $group): void
    {
        $db = DB::connection()->getPdo();

        $instructorQuery = $db->prepare(
            "SELECT id
                    FROM EXCURSION_INSTRUCTOR
                    WHERE instructor_id = :instructorId
                      AND excursion_id = :excursionId"
        );

        $instructorQuery->bindValue(':instructorId', $group->instructorId);
        $instructorQuery->bindValue(':excursionId', $group->excursionId);
        $instructorQuery->execute();

        $instructor = $instructorQuery->fetch();

        $query = $db->prepare(
            "INSERT INTO EXCURSION_GROUP(instructor_id, capacity, e_date)
                        VALUES (:instructor_id, :capacity, :e_date)"
        );
        $query->bindValue(':instructor_id', $instructor['id']);
        $query->bindValue(':capacity', $group->capacity);
        $query->bindValue(':e_date', date_format($group->dateTime, 'Y-m-d H:i:s'));

        if (!$query->execute()) return;
    }
}
