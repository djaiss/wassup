<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Cycle;
use App\Models\Goal;
use App\Models\Member;
use App\Exceptions\OrganizationMismatchException;

class CreateGoal
{
    private Goal $goal;

    public function __construct(
        public Cycle $cycle,
        public Member $member,
        public string $title,
        public ?string $description,
    ) {
    }

    public function execute(): Goal
    {
        $this->validate();
        $this->create();

        return $this->goal;
    }

    private function validate(): void
    {
        if ($this->member->organization_id !== $this->cycle->organization_id) {
            throw new OrganizationMismatchException('Member does not belong to the same organization as the cycle.');
        }
    }

    private function create(): void
    {
        $this->goal = Goal::create([
            'cycle_id' => $this->cycle->id,
            'member_id' => $this->member->id,
            'title' => $this->title,
            'description' => $this->description,
        ]);
    }
}
