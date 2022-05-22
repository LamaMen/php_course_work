<?php

namespace App\Models;

class Place
{
    public int $id;
    public string $title;
    public string $description;
    public float $rating;
    public array $photos;
    public bool $isArchive;

    function __construct(int    $id,
                         string $title,
                         string $description,
                         float  $rating,
                         bool   $isArchive,
                         array  $photos)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->rating = $rating;
        $this->isArchive = $isArchive;
        $this->photos = $photos;
    }

    static function fromDB(mixed $resultRow, array $params): Place
    {
        return new self(
            $resultRow['id'],
            $resultRow['title'],
            $resultRow['description'],
            $resultRow['rating'],
            $resultRow['isArchive'],
            $params['photos'],
        );
    }
}
