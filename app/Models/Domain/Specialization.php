<?php

namespace App\Models\Domain;

class Specialization
{
    public int $id;
    public string $name;

    function __construct(int    $id,
                         string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public static function fromDB(mixed $resultRow): Specialization
    {
        return new self(
            $resultRow['id'] ?? 0,
            $resultRow['name'],
        );
    }
}
