<?php

namespace App\Models;

use DateTime;

class Excursion extends Place
{
    public string $address;
    public DateTime $duration;
    public int $price;

    function __construct(int    $id,
                         string $title,
                         string $description,
                         string $address,
                         int    $price,
                         string $duration,
                         float  $rating,
                         string|null $photo)
    {
        $this->address = $address;
        $this->price = $price;
        $this->duration = DateTime::createFromFormat('H:i:s', $duration);
        parent::__construct($id, $title, $description, $rating, $photo);
    }

    function getDuration(): string
    {
        $hours = (int)$this->duration->format('H');
        $minutes = (int)$this->duration->format('i');
        if ($hours == 0) {
            return $minutes . ' мин';
        } elseif ($minutes == 0) {
            return $hours . ' ч ';
        } else {
            return $hours . ' ч ' . $minutes . ' мин';
        }
    }

    static function fromDB(mixed $resultRow): Excursion
    {
        return new self(
            $resultRow['id'],
            $resultRow['title'],
            $resultRow['description'],
            $resultRow['address'],
            $resultRow['price'],
            $resultRow['duration'],
            $resultRow['rating'],
            $resultRow['photo'],
        );
    }
}
