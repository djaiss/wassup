<?php

declare(strict_types=1);

namespace App\Actions;

use App\Exceptions\OrganizationMismatchException;
use App\Models\Cycle;
use App\Models\Organization;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CreateCycle
{
    private Cycle $cycle;

    public function __construct(
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
        $this->create();

        return $this->cycle;
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
}
