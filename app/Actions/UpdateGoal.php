<?php

declare(strict_types=1);

namespace App\Actions;

use App\Exceptions\OrganizationMismatchException;
use App\Models\Goal;
use App\Models\Member;

class UpdateGoal
{
    public function __construct(
        public Goal $goal,
        public Member $member,
        public string $title,
        public ?string $description,
    ) {
    }

    public function execute(): Goal
    {
        $this->validate();
        $this->update();

        return $this->goal;
    }

    private function validate(): void
    {
        if ($this->member->organization->id !== $this->goal->cycle->organization_id) {
            throw new OrganizationMismatchException('Member does not belong to the same organization as the cycle.');
        }
    }

    private function update(): void
    {
        $this->goal->update([
            'member_id' => $this->member->id,
            'title' => $this->title,
            'description' => $this->description,
        ]);
    }
}
