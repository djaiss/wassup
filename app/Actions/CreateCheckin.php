<?php

declare(strict_types=1);

namespace App\Actions;

use App\Exceptions\OrganizationMismatchException;
use App\Models\Checkin;
use App\Models\Cycle;
use App\Models\Goal;
use App\Models\Member;

class CreateCheckin
{
    private Checkin $checkin;

    public function __construct(
        public Cycle $cycle,
        public Member $member,
        public string $content,
    ) {
    }

    public function execute(): Checkin
    {
        $this->validate();
        $this->create();

        return $this->checkin;
    }

    private function validate(): void
    {
        if ($this->member->organization_id !== $this->cycle->organization_id) {
            throw new OrganizationMismatchException('Member does not belong to the same organization as the cycle.');
        }
    }

    private function create(): void
    {
        $this->checkin = Checkin::create([
            'cycle_id' => $this->cycle->id,
            'member_id' => $this->member->id,
            'content' => $this->content,
        ]);
    }
}
