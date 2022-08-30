<?php

namespace App\Models\Domain;

class Comment
{
    public int $id;
    public string $text;
    public float $rating;
    public User|null $user;
    public Place|null $place;

    function __construct(int        $id,
                         string     $text,
                         float      $rating,
                         User|null  $user,
                         Place|null $place)
    {
        $this->id = $id;
        $this->text = $text;
        $this->rating = $rating;
        $this->user = $user;
        $this->place = $place;
    }

    static function fromDB(mixed $resultRow, User|null $owner, Place|null $place): Comment
    {
        return new self(
            $resultRow['id'],
            $resultRow['comment_text'],
            $resultRow['rating'],
            $owner,
            $place,
        );
    }

    static function fromForm(mixed $form, User $user): Comment
    {
        return new self(
            -1,
            $form['comment'],
            $form['rating'],
            $user,
            Place::onlyId($form['place_id']),
        );
    }
}
