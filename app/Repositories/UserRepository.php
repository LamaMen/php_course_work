<?php

namespace App\Repositories;

use App\Models\Domain\User;
use Illuminate\Support\Facades\DB;
use PDOException;

class UserRepository
{
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
            if ($user->role == 'instructor') $this->addInstructor($id);

            $user->id = $id;
            return $user;
        } catch (PDOException $e) {
            return null;
        }
    }

    private function addInstructor(int $userId): void
    {
        // TODO - add specialization and surname
        $db = DB::connection()->getPdo();
        $query = $db->prepare(
            "INSERT INTO INSTRUCTOR(user_id, surname, specialization_id)
            VALUES (:userId, null, 1)"
        );
        $query->bindValue(':userId', $userId);
        $query->execute();
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
