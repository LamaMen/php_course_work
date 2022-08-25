<?php

namespace App\Models;

class Showplace extends Place
{
    public string $address;

    function __construct(int    $id,
                         string $title,
                         string $description,
                         float  $rating,
                         string $address,
                         string $photo)
    {
        $this->address = $address;
        parent::__construct($id, $title, $description, $rating, $photo);
    }

    static function fromDB(mixed $resultRow): Showplace
    {
        return new self(
            $resultRow['id'],
            $resultRow['title'],
            $resultRow['description'],
            $resultRow['rating'],
            $resultRow['address'],
            $resultRow['photo'],
        );
    }
}
