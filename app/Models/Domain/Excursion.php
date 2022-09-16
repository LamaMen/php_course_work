<?php

namespace App\Models\Domain;

use DateTime;

class Excursion extends Place
{
    public string $address;
    public DateTime $duration;
    public int $price;

    function __construct(int         $id,
                         int         $placeId,
                         string      $title,
                         string      $description,
                         string      $address,
                         int         $price,
                         DateTime    $duration,
                         float       $rating,
                         string|null $photo)
    {
        $this->address = $address;
        $this->price = $price;
        $this->duration = $duration;
        parent::__construct($id, $placeId, $title, $description, $rating, $photo);
    }

    public static function empty(): Excursion
    {
        return new self(
            -1,
            -1,
            '',
            '',
            '',
            0,
            DateTime::createFromFormat('H:i:s', '00:00:00'),
            0,
            null
        );
    }

    public function duration(): string
    {
        return date_format($this->duration, 'H:i');
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

    public static function fromForm(mixed $form, string|null $photo): Excursion
    {
        return new self(
            $form['id'],
            $form['place_id'],
            $form['title'],
            $form['description'],
            $form['address'],
            $form['price'],
            DateTime::createFromFormat('H:i', $form['duration']),
            0,
            $photo,
        );
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
            DateTime::createFromFormat('H:i:s', $resultRow['duration']),
            $resultRow['rating'],
            $resultRow['photo'],
        );
    }
}
