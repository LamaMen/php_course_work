<?php

namespace App\Models;

use DateTime;

class Excursion extends Place
{
    public array $dates;
    public string $destination;
    public int $peopleNumber;
    public int $adultPrice;
    public DateTime $duration;
    public int|null $childPrice;

    function __construct(int      $id,
                         string   $title,
                         string   $description,
                         float    $rating,
                         array    $dates,
                         string   $destination,
                         int      $peopleNumber,
                         int      $adultPrice,
                         int|null $childPrice,
                         string   $duration,
                         bool     $isArchive,
                         array    $photos)
    {
        $this->dates = $dates;
        $this->peopleNumber = $peopleNumber;
        $this->adultPrice = $adultPrice;
        $this->childPrice = $childPrice;
        $this->destination = $destination;
        $this->duration = DateTime::createFromFormat('H:i:s', $duration);
        parent::__construct($id, $title, $description, $rating, $isArchive, $photos);
    }

    function getDuration(): string
    {
        $hours = (int) $this->duration->format('H');
        $minutes = (int) $this->duration->format('i');
        if ($hours == 0) {
            return $minutes . ' мин';
        } elseif ($minutes == 0) {
            return $hours . ' ч ';
        } else {
            return $hours . ' ч ' . $minutes . ' мин';
        }
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
            $resultRow['adultPrice'],
            $resultRow['childPrice'],
            $resultRow['duration'],
            $resultRow['isArchive'],
            $params['photos'],
        );
    }
}
