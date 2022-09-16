<?php

namespace App\Models\Domain;

class PlaceInfo
{
    public int $id;
    public string $title;
    public bool $isExcursion;

    function __construct(int    $id,
                         string $title,
                         bool   $isExcursion)
    {
        $this->id = $id;
        $this->title = $title;
        $this->isExcursion = $isExcursion;
    }

    static function fromDB(mixed $resultRow): PlaceInfo
    {
        return new self(
            $resultRow['id'],
            $resultRow['title'],
            $resultRow['is_excursion'] == 1
        );
    }
}
