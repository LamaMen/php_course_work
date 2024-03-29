<?php

namespace App\Repositories;

use App\Models\Domain\Instructor;
use Illuminate\Support\Facades\DB;

class InstructorRepository
{
    public function save(Instructor $instructor): void
    {
        $db = DB::connection()->getPdo();
        $query = $db->prepare(
            "INSERT INTO INSTRUCTOR(user_id, surname, specialization_id)
            VALUES (:userId, :surname, :specialization)"
        );
        $query->bindValue(':userId', $instructor->id);
        $query->bindValue(':surname', $instructor->surname);
        $query->bindValue(':specialization', $instructor->specializationId);
        $query->execute();
    }

    public function update(Instructor $instructor): void
    {
        $db = DB::connection()->getPdo();
        $query = $db->prepare(
            "UPDATE INSTRUCTOR
            SET surname = :surname, specialization_id = :specialization
            WHERE id = :id"
        );

        $query->bindValue(':id', $instructor->instructorId);
        $query->bindValue(':surname', $instructor->surname);
        $query->bindValue(':specialization', $instructor->specializationId);
        $query->execute();
    }

    public function getById(int $id): Instructor|null
    {
        $pdo = DB::connection()->getPdo();
        $query = $pdo->prepare(
            "SELECT u.id as id,
                            u.first_name as first_name,
                            u.second_name as second_name,
                            u.email as email,
                            u.passwd as passwd,
                            u.u_role as u_role,
                            u.photo as photo,
                            i.id as instructor_id,
                            i.surname as surname,
                            i.specialization_id as specialization_id
                    FROM INSTRUCTOR i INNER JOIN USERS u on i.user_id = u.id
                    WHERE u.id = :id
        ");

        $query->bindValue(':id', $id);
        $query->execute();
        $instructor = $query->fetch();

        if (!$instructor) {
            return null;
        }

        return Instructor::fromDB($instructor);
    }

    public function getByNativeId(int $id): Instructor|null
    {
        $pdo = DB::connection()->getPdo();
        $query = $pdo->prepare(
            "SELECT u.id as id,
                            u.first_name as first_name,
                            u.second_name as second_name,
                            u.email as email,
                            u.passwd as passwd,
                            u.u_role as u_role,
                            u.photo as photo,
                            i.id as instructor_id,
                            i.surname as surname,
                            i.specialization_id as specialization_id
                    FROM INSTRUCTOR i INNER JOIN USERS u on i.user_id = u.id
                    WHERE i.id = :id
        ");

        $query->bindValue(':id', $id);
        $query->execute();
        $instructor = $query->fetch();

        if (!$instructor) {
            return null;
        }

        return Instructor::fromDB($instructor);
    }

    public function getAll(): array
    {
        $pdo = DB::connection()->getPdo();
        $query = $pdo->prepare(
            "SELECT u.id as id,
                            u.first_name as first_name,
                            u.second_name as second_name,
                            u.email as email,
                            u.passwd as passwd,
                            u.u_role as u_role,
                            u.photo as photo,
                            i.id as instructor_id,
                            i.surname as surname,
                            i.specialization_id as specialization_id
                    FROM INSTRUCTOR i INNER JOIN USERS u on i.user_id = u.id
        ");

        $query->execute();
        $instructors = $query->fetchAll();

        if (!$instructors) {
            return [];
        }

        return array_map(function ($instructor) {
            return Instructor::fromDB($instructor);
        }, $instructors);
    }

    public function getByPlace(int $placeId): array
    {
        $pdo = DB::connection()->getPdo();
        $query = $pdo->prepare(
            "SELECT u.id as id,
                            u.first_name as first_name,
                            u.second_name as second_name,
                            u.email as email,
                            u.passwd as passwd,
                            u.u_role as u_role,
                            u.photo as photo,
                            i.id as instructor_id,
                            i.surname as surname,
                            i.specialization_id as specialization_id
                    FROM EXCURSION_INSTRUCTOR e
                        LEFT JOIN INSTRUCTOR i on i.id = e.instructor_id
                        INNER JOIN USERS u on i.user_id = u.id
                    WHERE e.excursion_id = :placeId
        ");

        $query->bindValue(':placeId', $placeId);
        $query->execute();
        $instructors = $query->fetchAll();

        if (!$instructors) {
            return [];
        }

        return array_map(function ($instructor) {
            return Instructor::fromDB($instructor);
        }, $instructors);
    }
}
