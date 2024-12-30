<?php

declare(strict_types=1);

namespace App\Actions;

use App\Exceptions\CycleNumberMustBePositiveException;
use App\Exceptions\CycleStartedAtMustBeBeforeEndedAtException;
use App\Exceptions\OrganizationMismatchException;
use App\Models\Cycle;
use App\Models\User;
use Carbon\Carbon;

class UpdateCycle
{
    public function __construct(
        public User $user,
        public Cycle $cycle,
        public string $description,
        public int $number,
        public Carbon $startedAt,
        public Carbon $endedAt,
        public bool $isPublic,
        public bool $isActive,
    ) {
    }

    public function execute(): Cycle
    {
        $this->validate();
        $this->update();
        $this->toggle();

        return $this->cycle;
    }

    private function validate(): void
    {
        if (! $this->user->isAdministratorOf($this->cycle->organization)) {
            throw new OrganizationMismatchException('User is not an administrator of the organization.');
        }

        // if the cycle number is not a positive integer, throw an exception
        if ($this->number <= 0) {
            throw new CycleNumberMustBePositiveException();
        }

        // if the started at date is after the ended at date, throw an exception
        if ($this->startedAt && $this->endedAt && $this->startedAt->greaterThan($this->endedAt)) {
            throw new CycleStartedAtMustBeBeforeEndedAtException();
        }
    }

    private function update(): void
    {
        $this->cycle->update([
            'description' => $this->description,
            'number' => $this->number,
            'started_at' => $this->startedAt->toDateString(),
            'ended_at' => $this->endedAt->toDateString(),
            'is_public' => $this->isPublic,
            'is_active' => $this->isActive,
        ]);
    }

    private function toggle(): void
    {
        if ($this->isActive) {
            (new ToggleCycle(
                cycle: $this->cycle,
                isActive: true,
            ))->execute();
        }
    }
}
