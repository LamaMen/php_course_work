<?php

namespace App\View\Components\Places;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Rating extends Component
{
    public float $rating;
    public string $color;
    private bool $isGeneral;

    public function __construct(float $rating, bool $isGeneral = true)
    {
        $this->rating = $rating;
        $this->isGeneral = $isGeneral;
    }

    public function formattedRating(): string
    {
        if ($this->isGeneral) {
            return number_format($this->rating, 2);
        }

        return number_format($this->rating, 0);

    }

    public function render(): View|Closure|string
    {
        if ($this->rating < 2.5) {
            $this->color = 'bg-danger';
        } elseif ($this->rating < 4) {
            $this->color = 'bg-warning';
        } else {
            $this->color = 'bg-success';
        }

        return view('components.places.rating');
    }
}
