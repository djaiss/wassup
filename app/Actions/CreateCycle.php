<?php

declare(strict_types=1);

namespace App\Actions;

use App\Exceptions\CycleNumberAlreadyTakenException;
use App\Exceptions\CycleNumberMustBePositiveException;
use App\Exceptions\CycleStartedAtMustBeBeforeEndedAtException;
use App\Exceptions\OrganizationMismatchException;
use App\Models\Cycle;
use App\Models\Organization;
use App\Models\User;
use Carbon\Carbon;

class CreateCycle
{
    private Cycle $cycle;

    public function __construct(
        public User $user,
        public Organization $organization,
        public int $number,
        public string $description,
        public ?Carbon $startedAt,
        public ?Carbon $endedAt,
        public bool $isActive,
        public bool $isPublic,
    ) {
    }

    public function execute(): Cycle
    {
        $this->validate();
        $this->create();
        $this->toggle();

        return $this->cycle;
    }

    private function validate(): void
    {
        if (! $this->user->isAdministratorOf($this->organization)) {
            throw new OrganizationMismatchException('User is not an administrator of the organization.');
        }

        // if the cycle number is already taken, throw an exception
        if (Cycle::where('organization_id', $this->organization->id)->where('number', $this->number)->exists()) {
            throw new CycleNumberAlreadyTakenException();
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

    private function create(): void
    {
        $this->cycle = Cycle::create([
            'organization_id' => $this->organization->id,
            'number' => $this->number,
            'description' => $this->description,
            'started_at' => $this->startedAt->toDateString(),
            'ended_at' => $this->endedAt->toDateString(),
            'is_active' => $this->isActive,
            'is_public' => $this->isPublic,
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
