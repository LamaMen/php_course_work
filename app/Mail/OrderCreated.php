<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class OrderCreated extends Mailable
{
    use Queueable, SerializesModels;

    public string $excursion;
    public int $groupId;
    public string $user;

    public function __construct(int $groupId)
    {
        $this->groupId = $groupId;
    }

    private function getExcursionName(): void
    {
        $pdo = DB::connection()->getPdo();
        $query = $pdo->prepare(
            "SELECT p.title as title
                    FROM EXCURSION_GROUP g
                        INNER JOIN EXCURSION_INSTRUCTOR i on g.instructor_id = i.id
                        INNER JOIN EXCURSION e on i.excursion_id = e.id
                        INNER JOIN PLACE p on e.place_id = p.id
                    WHERE g.id = :group_id");

        $query->bindValue(':group_id', $this->groupId);
        $query->execute();
        $excursion = $query->fetch();

        $query = $pdo->prepare(
            "SELECT *
                    FROM USERS
                    WHERE id = :user_id");

        $query->bindValue(':user_id', Cookie::get('user_id'));
        $query->execute();
        $user = $query->fetch();

        $this->excursion = $excursion['title'];
        $this->user = $user['email'];
    }

    public function build(): static
    {
        $this->getExcursionName();
        return $this->to($this->user)
            ->subject('Вы оформили заказ')
            ->view('emails.order-created');
    }
}
