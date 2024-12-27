<?php

namespace App\Http\ViewModels;

use App\Models\Checkin;
use App\Models\Cycle;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class CheckinViewModel
{
    /**
     * Get all the weeks of a cycle.
     */
    public static function weekSelector(Cycle $cycle): array
    {
        // get the number of weeks in the cycle so far
        if (! $cycle->started_at) {
            return [];
        }

        $numberOfWeeks = max(1, (int) ceil(
            $cycle->started_at->floatDiffInWeeks(
                $cycle->ended_at ?? now()
            )
        ));

        for ($i = 1; $i <= $numberOfWeeks; $i++) {
            $weeks[] = [
                'number' => $i,
                'week' => trans('Week :number', ['number' => $i]),
                'start_day' => $cycle->started_at->copy()->addWeeks($i - 1)->startOfWeek()->format('M d'),
                'end_day' => $cycle->started_at->copy()->addWeeks($i - 1)->endOfWeek()->format('M d'),
                'is_current_week' => $cycle->started_at->copy()->addWeeks($i - 1)->isCurrentWeek(),
                'url' => [
                    'week' => route('organizations.checkins.weeks.show', [
                        'slug' => $cycle->organization->slug,
                        'cycle' => $cycle->number,
                        'week' => $i,
                    ]),
                ],
            ];
        }

        return $weeks;
    }

    /**
     * Show all check-ins of a member for a cycle for the given week.
     * A week is defined by the start day of the week. A week is 5 days (Monday
     * to Friday).
     */
    public static function show(Cycle $cycle, Member $member, Carbon $startDay): Collection
    {
        return $cycle->checkins()
            ->where('member_id', $member->id)
            ->whereBetween('created_at', [$startDay->copy()->startOfWeek(1), $startDay->copy()->endOfWeek(5)])
            ->with('member')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(fn (Checkin $checkin): array => self::checkin($checkin));
    }

    public static function checkin(Checkin $checkin): array
    {
        return [
            'id' => $checkin->id,
            'raw_content' => $checkin->content,
            'content' => $checkin->getMarkdownDescription(),
            'member' => [
                'id' => $checkin->member->id,
                'name' => $checkin->member->name,
            ],
            'created_at' => $checkin->created_at->toISOString(),
        ];
    }
}
