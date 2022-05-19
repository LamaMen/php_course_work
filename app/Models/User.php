<?php

namespace App\Models;

class User
{
    public int $id;
    public string $firstname;
    public string $lastname;
    public string $email;
    public string $password;
    public string $role;

    function __construct(int    $id,
                         string $firstname,
                         string $lastname,
                         string $email,
                         string $password,
                         string $role)
    {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    public static function fromForm(mixed $form): User
    {
        return new self(
            $form['id'] ?? 0,
            $form['firstname'],
            $form['lastname'],
            $form['email'],
            $form['password'],
            $form['role']
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
            $resultRow['u_role']
        );
    }

    public function validatePassword(): bool
    {
        $uppercase = preg_match('@[A-Z]@', $this->password);
        $lowercase = preg_match('@[a-z]@', $this->password);
        $number = preg_match('@\d@', $this->password);
        return $uppercase and $lowercase and $number and strlen($this->password) >= 4;
    }
}
