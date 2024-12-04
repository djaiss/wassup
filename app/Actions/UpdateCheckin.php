<?php

declare(strict_types=1);

namespace App\Actions;

use App\Exceptions\OrganizationMismatchException;
use App\Models\Checkin;
use App\Models\Member;

class UpdateCheckin
{
    public function __construct(
        public Checkin $checkin,
        public Member $member,
        public string $content,
    ) {
    }

    public function execute(): Checkin
    {
        $this->validate();
        $this->update();

        return $this->checkin;
    }

    private function validate(): void
    {
        if ($this->member->organization->id !== $this->checkin->cycle->organization_id) {
            throw new OrganizationMismatchException('Member does not belong to the same organization as the cycle.');
        }
    }

    private function update(): void
    {
        $this->checkin->update([
            'member_id' => $this->member->id,
            'content' => $this->content,
        ]);
    }
}
