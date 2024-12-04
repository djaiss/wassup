<?php

namespace App\Http\ViewModels;

use App\Models\Checkin;
use App\Models\Cycle;
use App\Models\Goal;
use App\Models\Member;
use Illuminate\Support\Collection;

class CheckinViewModel
{
    /**
     * Show all check-ins of a member for a cycle
     */
    public static function show(Cycle $cycle, Member $member): Collection
    {
        return $cycle->checkins()
            ->where('member_id', $member->id)
            ->with('member')
            ->get()
            ->map(fn (Checkin $checkin): array => [
                'id' => $checkin->id,
                'raw_content' => $checkin->content,
                'content' => $checkin->getMarkdownDescription(),
                'member' => [
                    'id' => $checkin->member->id,
                    'name' => $checkin->member->name,
                ],
                'created_at' => $checkin->created_at->format('Y-m-d'),
            ]);
    }
}
