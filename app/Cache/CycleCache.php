<?php

namespace App\Cache;

use App\Helpers\CacheHelper;
use App\Http\ViewModels\CycleViewModel;
use App\Http\ViewModels\Vaults\Contacts\ContactViewModel;
use App\Models\Contact;
use App\Models\Cycle;
use App\Models\Organization;
use App\Models\User;
use App\Traits\CacheIdentifier;

/**
 * All the information about a contact: name, job info, background info.
 */
final class CycleCache extends CacheHelper
{
    use CacheIdentifier;

    protected string $key = 'organization.cycle:%s';

    protected int $ttl = 604800; // 1 week

    public function __construct(
        protected readonly Organization $organization,
        protected readonly Cycle $cycle,
    ) {
        $this->identifier = $organization->id.'_'.$cycle->id;
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
