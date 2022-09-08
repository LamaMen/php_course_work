<?php

namespace App\Models\Domain;

class User
{
    public int $id;
    public string $firstname;
    public string $lastname;
    public string $email;
    public string $password;
    public string $role;
    public string $photo;

    function __construct(int         $id,
                         string      $firstname,
                         string      $lastname,
                         string      $email,
                         string      $password,
                         string      $role,
                         string|null $photo)
    {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->photo = $photo ?? 'https://cdn.dribbble.com/users/304574/screenshots/6222816/male-user-placeholder.png?compress=1&resize=800x600&vertical=top';
    }

    public static function onlyId(int $id): User
    {
        return new self(
            $id,
            '',
            '',
            '',
            '',
            '',
            null
        );
    }

    public static function fromForm(mixed $form, string|null $photo = null): User
    {
        return new self(
            $form['id'] ?? 0,
            $form['firstname'],
            $form['lastname'],
            $form['email'],
            $form['password'],
            $form['role'],
            $photo,
        );
    }

    public static function fromDB(mixed $resultRow): User
    {
        return new self(
            $resultRow['id'] ?? 0,
            $resultRow['first_name'],
            $resultRow['second_name'],
            $resultRow['email'],
            $resultRow['passwd'],
            $resultRow['u_role'],
            $resultRow['photo'],
        );
    }

    public function validatePassword(): bool
    {
        $uppercase = preg_match('@[A-Z]@', $this->password);
        $lowercase = preg_match('@[a-z]@', $this->password);
        $number = preg_match('@\d@', $this->password);
        return $uppercase and $lowercase and $number and strlen($this->password) >= 4;
    }

    public function fullName(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}
