<?php

namespace App\Repositories;

use App\Models\Domain\Instructor;
use App\Models\Domain\User;
use Illuminate\Support\Facades\DB;
use PDOException;

class UserRepository
{
    private InstructorRepository $repository;

    function __construct(InstructorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function save(User $user): User|null
    {
        try {
            $db = DB::connection()->getPdo();
            $query = $db->prepare(
                "INSERT INTO USERS(first_name, second_name, email, passwd, u_role)
            VALUES (:firstname, :lastname, :email, :passwd, :role)"
            );
            $query->bindValue(':firstname', $user->firstname);
            $query->bindValue(':lastname', $user->lastname);
            $query->bindValue(':email', $user->email);
            $query->bindValue(':passwd', $user->password);
            $query->bindValue(':role', $user->role);
            if (!$query->execute()) return null;

            $id = $db->lastInsertId();
            $user->id = $id;

            if ($user instanceof Instructor) $this->repository->save($user);
            return $user;
        } catch (PDOException) {
            return null;
        }
    }

    public function update(User $user): void
    {
        try {
            $db = DB::connection()->getPdo();
            $query = $db->prepare(
                "UPDATE USERS
                SET first_name = :firstname,
                    second_name = :lastname,
                    email = :email,
                    passwd = :passwd,
                    u_role = :role,
                    photo = :photo
                WHERE id = :id"
            );

            $query->bindValue(':id', $user->id);
            $query->bindValue(':firstname', $user->firstname);
            $query->bindValue(':lastname', $user->lastname);
            $query->bindValue(':email', $user->email);
            $query->bindValue(':passwd', $user->password);
            $query->bindValue(':role', $user->role);
            $query->bindValue(':photo', $user->photo);
            if (!$query->execute()) return;

            if ($user instanceof Instructor) $this->repository->update($user);
        } catch (PDOException) {
            return;
        }
    }

    public function getByEmail(string $email): User|null
    {
        $pdo = DB::connection()->getPdo();
        $query = $pdo->prepare("SELECT * FROM USERS WHERE email = :email");
        $query->bindValue(':email', $email);
        $query->execute();
        $user = $query->fetch();

        if (!$user) {
            return null;
        }

        return User::fromDB($user);
    }

    public function getById(int $id): User|null
    {
        $pdo = DB::connection()->getPdo();
        $query = $pdo->prepare("SELECT * FROM USERS WHERE id = :id");
        $query->bindValue(':id', $id);
        $query->execute();
        $user = $query->fetch();

        if (!$user) {
            return null;
        }

        return User::fromDB($user);
    }
}
