<?php

namespace App\Repositories;

use App\Models\Domain\Specialization;
use Illuminate\Support\Facades\DB;

class SpecializationsRepository
{
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
