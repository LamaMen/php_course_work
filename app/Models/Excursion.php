<?php

namespace App\Models;

use DateTime;

class Excursion
{
    public int $id;
    public string $title;
    public string $description;
    public float $rating;
    public DateTime $dateTime;
    public string $destination;
    public int $peopleNumber;
    public int $price;
    public array $photos;

    function __construct(int      $id,
                         string   $title,
                         string   $description,
                         float    $rating,
                         string $dateTime,
                         string   $destination,
                         int      $peopleNumber,
                         int      $price,
                         array    $photos)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->rating = $rating;
        $this->photos = $photos;
        $this->dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $dateTime);
        $this->peopleNumber = $peopleNumber;
        $this->price = $price;
        $this->destination = $destination;
    }

    static function fromDB(mixed $resultRow, array $photos): Excursion
    {
        return new self(
            $resultRow['id'],
            $resultRow['title'],
            $resultRow['description'],
            $resultRow['rating'],
            $resultRow['excursionDate'],
            $resultRow['destination'],
            $resultRow['peopleNumber'],
            $resultRow['price'],
            $photos,
        );
    }
}
