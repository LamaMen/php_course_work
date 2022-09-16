<?php

namespace App\Models\Domain;

class Showplace extends Place
{
    public string $address;

    function __construct(int         $id,
                         int         $placeId,
                         string      $title,
                         string      $description,
                         float       $rating,
                         string      $address,
                         string|null $photo)
    {
        $this->address = $address;
        parent::__construct($id, $placeId, $title, $description, $rating, $photo);
    }

    public static function empty(): Showplace
    {
        return new self(
            -1,
            -1,
            '',
            '',
            0,
            '',
            null
        );
    }

    public static function fromForm(mixed $form, string|null $photo): Showplace
    {
        return new self(
            $form['id'],
            $form['place_id'],
            $form['title'],
            $form['description'],
            0,
            $form['address'],
            $photo,
        );
    }

    static function fromDB(mixed $resultRow): Showplace
    {
        return new self(
            $resultRow['id'],
            $resultRow['place_id'],
            $resultRow['title'],
            $resultRow['description'],
            $resultRow['rating'],
            $resultRow['address'],
            $resultRow['photo']
        );
    }
}
