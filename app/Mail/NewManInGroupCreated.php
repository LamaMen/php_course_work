<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class NewManInGroupCreated extends Mailable
{
    use Queueable, SerializesModels;

    public string $excursion;
    public int $groupId;
    public string $instructor;

    public function __construct(int $groupId)
    {
        $this->groupId = $groupId;
    }

    public function build(): static
    {
        $this->getExcursionName();
        return $this->to($this->instructor)
            ->subject('Новый пользователь в группе')
            ->view('emails.new-man-group');
    }

    private function getExcursionName(): void
    {
        $pdo = DB::connection()->getPdo();
        $query = $pdo->prepare(
            "SELECT p.title as title, u.email as email
                    FROM EXCURSION_GROUP g
                        INNER JOIN EXCURSION_INSTRUCTOR i on g.instructor_id = i.id
                        INNER JOIN EXCURSION e on i.excursion_id = e.id
                        INNER JOIN PLACE p on e.place_id = p.id
                        INNER JOIN INSTRUCTOR i2 on i.instructor_id = i2.id
                        INNER JOIN USERS u on i2.user_id = u.id
                    WHERE g.id = :group_id");

        $query->bindValue(':group_id', $this->groupId);
        $query->execute();
        $excursion = $query->fetch();

        $this->excursion = $excursion['title'];
        $this->instructor = $excursion['email'];
    }
}
