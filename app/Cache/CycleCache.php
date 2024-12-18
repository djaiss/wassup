<?php

namespace App\Cache;

use App\Helpers\CacheHelper;
use App\Http\ViewModels\CycleViewModel;
use App\Models\Cycle;
use App\Models\Organization;
use App\Traits\CacheIdentifier;

/**
 * All the information about a cycle, including previous and next cycles.
 */
final class CycleCache extends CacheHelper
{
    use CacheIdentifier;

    protected string $key = 'organization.cycle:%s';

    protected int $ttl = 604800; // 1 week

    public function __construct(
        private Organization $organization,
        private Cycle $cycle,
    ) {
        $this->identifier = $organization->id . '_' . $cycle->id;
    }

    public static function make(Organization $organization, Cycle $cycle): static
    {
        return new self($organization, $cycle);
    }

    protected function generate(): array
    {
        return CycleViewModel::show($this->cycle);
    }
}
