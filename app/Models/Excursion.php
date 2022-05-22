<?php

namespace App\Models;

class Excursion extends Place
{
    public array $dates;
    public string $destination;
    public int $peopleNumber;
    public int $price;

    function __construct(int    $id,
                         string $title,
                         string $description,
                         float  $rating,
                         array  $dates,
                         string $destination,
                         int    $peopleNumber,
                         int    $price,
                         bool   $isArchive,
                         array  $photos)
    {
        $this->dates = $dates;
        $this->peopleNumber = $peopleNumber;
        $this->price = $price;
        $this->destination = $destination;
        parent::__construct($id, $title, $description, $rating, $isArchive, $photos);
    }

    static function fromDB(mixed $resultRow, array $params): Excursion
    {
        return new self(
            $resultRow['id'],
            $resultRow['title'],
            $resultRow['description'],
            $resultRow['rating'],
            $params['dates'],
            $resultRow['destination'],
            $resultRow['peopleNumber'],
            $resultRow['price'],
            $resultRow['isArchive'],
            $params['photos'],
        );
    }
}
