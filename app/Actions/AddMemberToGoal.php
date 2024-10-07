<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Goal;
use App\Models\Member;

class AddMemberToGoal
{
    public function __construct(
        public Goal $goal,
        public Member $member,
    ) {
    }

    public function execute(): Goal
    {
        $this->associate();

        return $this->goal;
    }

    private function associate(): void
    {
        $this->goal->members()->save($this->member);
    }
}
