<?php

namespace App\Models\Domain;

use DateTime;

class Excursion extends Place
{
    public string $address;
    public DateTime $duration;
    public int $price;

    function __construct(int         $id,
                         int $placeId,
                         string      $title,
                         string      $description,
                         string      $address,
                         int         $price,
                         string      $duration,
                         float       $rating,
                         string|null $photo)
    {
        $this->address = $address;
        $this->price = $price;
        $this->duration = DateTime::createFromFormat('H:i:s', $duration);
        parent::__construct($id, $placeId, $title, $description, $rating, $photo);
    }

    public function getDuration(bool $isFull = false): string
    {
        $hours = (int)$this->duration->format('H');
        $minutes = (int)$this->duration->format('i');

        $hoursName = $isFull ?
            $this->getFormattedStringByValue($hours, ' час ', ' часа ', ' часов ')
            : ' ч ';

        $minutesName = $isFull ?
            $this->getFormattedStringByValue($minutes, ' минута', ' минуты', ' минут')
            : ' мин';

        if ($hours == 0) {
            return $minutes . $minutesName;
        } elseif ($minutes == 0) {
            return $hours . $hoursName;
        } else {
            return $hours . $hoursName . $minutes . $minutesName;
        }
    }

    private function getFormattedStringByValue(int $value, string $firstVersion, string $secondVersion, string $thirdVersion): string
    {
        $firstRank = $value % 10;
        $secondRank = ($value / 10) % 100;

        if ($secondRank != 1) {
            if ($firstRank == 1) return $firstVersion;
            if ($firstRank >= 2 && $firstRank <= 4) return $secondVersion;
        }

        return $thirdVersion;
    }

    static function fromDB(mixed $resultRow): Excursion
    {
        return new self(
            $resultRow['id'],
            $resultRow['place_id'],
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
