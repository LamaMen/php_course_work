<?php

namespace App\Models\Domain;

class Place
{
    public int $id;
    public int $placeId;
    public string $title;
    public string $description;
    public float $rating;
    public string $photo;
    public User|null $owner;

    function __construct(int         $id,
                         int         $placeId,
                         string      $title,
                         string      $description,
                         float       $rating,
                         string|null $photo,
                         User|null   $owner)
    {
        $this->id = $id;
        $this->placeId = $placeId;
        $this->title = $title;
        $this->description = $description;
        $this->rating = $rating;
        $this->photo = $photo ?? 'https://via.placeholder.com/640x360?text=GreatLuking';
        $this->owner = $owner;
    }

    public static function onlyId(int $id): Place
    {
        return new self(
            -1,
            $id,
            '',
            '',
            -1,
            '',
            null
        );
    }
}
