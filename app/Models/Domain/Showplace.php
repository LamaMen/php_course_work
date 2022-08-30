<?php

namespace App\Models\Domain;

class Showplace extends Place
{
    public string $address;

    function __construct(int       $id,
                         int       $placeId,
                         string    $title,
                         string    $description,
                         float     $rating,
                         string    $address,
                         string    $photo,
                         User|null $owner)
    {
        $this->address = $address;
        parent::__construct($id, $placeId, $title, $description, $rating, $photo, $owner);
    }

    static function fromDB(mixed $resultRow, User|null $owner): Showplace
    {
        return new self(
            $resultRow['id'],
            $resultRow['place_id'],
            $resultRow['title'],
            $resultRow['description'],
            $resultRow['rating'],
            $resultRow['address'],
            $resultRow['photo'],
            $owner,
        );
    }
}
