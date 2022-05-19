<?php

namespace App\Repositories;

use App\Models\User;
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
            $query->execute();
            $id = $db->lastInsertId();
            $user->id = $id;
            return $user;
        } catch (PDOException $e) {
            return null;
        }
    }

    public function getByEmail(string $email): User|null
    {
        $pdo = DB::connection()->getPdo();
        $query = $pdo->prepare("SELECT * FROM USERS WHERE email = :email");
        $query->bindValue(':email', $email);
        $query->execute();
        $users = $query->fetch();

        if (!$users) {
            return null;
        }

        return User::fromDB($users);
    }
}
