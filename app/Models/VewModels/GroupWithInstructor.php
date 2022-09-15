<?php

namespace App\Models\VewModels;

use App\Models\Domain\Group;
use App\Models\Domain\Instructor;

class GroupWithInstructor
{
    public Group $group;
    public Instructor $instructor;

    function __construct(Group      $group,
                         Instructor $instructor)
    {
        $this->group = $group;
        $this->instructor = $instructor;
    }
}
