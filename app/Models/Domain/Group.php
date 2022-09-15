<?php

namespace App\Models\Domain;

use DateTime;

class Group
{
    public int $id;
    public int $excursionId;
    public int $instructorId;
    public int $capacity;
    public int $engaged;
    public DateTime $dateTime;

    function __construct(int      $id,
                         int      $excursionId,
                         int      $instructorId,
                         int      $capacity,
                         int      $engaged,
                         DateTime $dateTime)
    {
        $this->id = $id;
        $this->excursionId = $excursionId;
        $this->instructorId = $instructorId;
        $this->capacity = $capacity;
        $this->engaged = $engaged;
        $this->dateTime = $dateTime;
    }

    public function date(): string
    {
        return date_format($this->dateTime, 'd.m');
    }

    public function time(): string
    {
        return date_format($this->dateTime, 'H:i');
    }

    public function capacity(): string
    {
        return $this->engaged . ' / ' . $this->capacity;
    }

    static function fromForm(mixed $form, int $instructorId): Group
    {
        return new self(
            0,
            $form['excursion'],
            $instructorId,
            $form['capacity'],
            0,
            DateTime::createFromFormat('Y-m-d\TH:i', $form['dateTime'])
        );
    }

    static function fromDB(mixed $resultRow): Group
    {
        return new self(
            $resultRow['id'],
            $resultRow['excursion_id'],
            $resultRow['instructor_id'],
            $resultRow['capacity'],
            $resultRow['users'],
            DateTime::createFromFormat('Y-m-d H:i:s', $resultRow['date'])
        );
    }
}
