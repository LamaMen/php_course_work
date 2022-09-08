<?php

namespace App\Models\Domain;

class Instructor extends User
{
    public int $instructorId;
    public string $surname;
    public int|null $specializationId;

    function __construct(int         $id,
                         string      $firstname,
                         string      $lastname,
                         string      $email,
                         string      $password,
                         string      $role,
                         string|null $photo,
                         int         $instructorId,
                         string      $surname,
                         int|null    $specializationId)
    {
        $this->instructorId = $instructorId;
        $this->surname = $surname;
        $this->specializationId = $specializationId;
        parent::__construct($id, $firstname, $lastname, $email, $password, $role, $photo);
    }

    public static function fromForm(mixed $form, string|null $photo = null): Instructor
    {
        $spec = $form['specialization'] == -1 ? null : $form['specialization'];

        return new self(
            $form['id'] ?? 0,
            $form['firstname'],
            $form['lastname'],
            $form['email'],
            $form['password'],
            $form['role'],
            $photo,
            $form['instructor_id'] ?? 0,
            $form['surname'],
            $spec
        );
    }

    public static function fromDB(mixed $resultRow): Instructor
    {
        return new self(
            $resultRow['id'] ?? 0,
            $resultRow['first_name'],
            $resultRow['second_name'],
            $resultRow['email'],
            $resultRow['passwd'],
            $resultRow['u_role'],
            $resultRow['photo'],
            $resultRow['instructor_id'],
            $resultRow['surname'],
            $resultRow['specialization_id'],
        );
    }
}
