<?php

namespace App\Models\Domain;

class Instructor extends User
{
    public int $instructorId;
    public string $surname;
    public int $specializationId;

    function __construct(int    $id,
                         string $firstname,
                         string $lastname,
                         string $email,
                         string $password,
                         string $role,
                         int    $instructorId,
                         string $surname,
                         int    $specializationId)
    {
        $this->instructorId = $instructorId;
        $this->surname = $surname;
        $this->specializationId = $specializationId;
        parent::__construct($id, $firstname, $lastname, $email, $password, $role);
    }

    public static function fromForm(mixed $form): Instructor
    {
        return new self(
            $form['id'] ?? 0,
            $form['firstname'],
            $form['lastname'],
            $form['email'],
            $form['password'],
            $form['role'],
            0,
            $form['surname'],
            $form['specialization']
        );
    }
}
