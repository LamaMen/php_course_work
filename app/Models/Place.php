<?php

namespace App\Models;

// TODO - Must contain owner
class Place
{
    public int $id;
    public string $title;
    public string $description;
    public float $rating;
    public string $photo;

    function __construct(int         $id,
                         string      $title,
                         string      $description,
                         float       $rating,
                         string|null $photo)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->rating = $rating;
        $this->photo = $photo ?? 'https://via.placeholder.com/640x360?text=GreatLuking';
    }
}
