<?php

namespace App\Repositories;

use App\Models\Domain\Specialization;
use Illuminate\Support\Facades\DB;

class SpecializationsRepository
{
    public function create(string $name): void
    {
        $db = DB::connection()->getPdo();
        $query = $db->prepare("INSERT INTO SPECIALIZATION(name) VALUES (:name)");
        $query->bindValue(':name', $name);

        if (!$query->execute()) return;
    }

    public function delete(int $id): void
    {
        $db = DB::connection()->getPdo();
        $query = $db->prepare("DELETE FROM SPECIALIZATION WHERE id = :id");
        $query->bindParam(':id', $id);

        if (!$query->execute()) return;
    }

    public function getSpecializations(): array
    {
        $pdo = DB::connection()->getPdo();
        $query = $pdo->prepare("SELECT * FROM SPECIALIZATION");
        $query->execute();
        $specializations = $query->fetchAll();

        if (!$specializations) {
            return array();
        }

        return array_map(function ($specialization) {
            return Specialization::fromDB($specialization);
        }, $specializations);
    }

    public function getSpecializationById(int $id): Specialization|null
    {
        $pdo = DB::connection()->getPdo();
        $query = $pdo->prepare("SELECT * FROM SPECIALIZATION WHERE id = :id");
        $query->bindValue(':id', $id);
        $query->execute();
        $specialization = $query->fetch();

        if (!$specialization) {
            return null;
        }

        return Specialization::fromDB($specialization);
    }
}
