<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\DestroyCycle;
use App\Actions\UpdateCycle;
use App\Http\ViewModels\CycleViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CycleController extends Controller
{
    public function new(Request $request): View
    {
        $organization = $request->attributes->get('organization');
        $member = $request->attributes->get('member');

        return view('organizations.cycles.new', [
            'organization' => $organization,
            'member' => $member,
        ]);
    }

    public function show(Request $request): View
    {
        $organization = $request->attributes->get('organization');
        $member = $request->attributes->get('member');
        $cycle = $request->attributes->get('cycle');

        $data = CycleViewModel::show($cycle);

        return view('organizations.show', [
            'organization' => $organization,
            'member' => $member,
            'cycle' => $data['cycle'],
            'nextCycle' => $data['nextCycle'],
            'previousCycle' => $data['previousCycle'],
        ]);
    }

    public function edit(Request $request): View
    {
        $organization = $request->attributes->get('organization');
        $member = $request->attributes->get('member');
        $cycle = $request->attributes->get('cycle');

        return view('organizations.cycles.edit', [
            'organization' => $organization,
            'member' => $member,
            'cycle' => $cycle,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $organization = $request->attributes->get('organization');
        $cycle = $request->attributes->get('cycle');

        (new UpdateCycle(
            cycle: $cycle,
            description: $request->input('description'),
            number: $cycle->number,
            startedAt: $cycle->started_at,
            endedAt: $cycle->ended_at,
            isPublic: $cycle->is_public,
        ))->execute();

        return redirect()->route('organizations.cycles.show', [
            'slug' => $organization->slug,
            'cycle' => $cycle->number,
        ]);
    }

    public function delete(Request $request): View
    {
        $organization = $request->attributes->get('organization');
        $member = $request->attributes->get('member');
        $cycle = $request->attributes->get('cycle');

        return view('organizations.cycles.delete', [
            'organization' => $organization,
            'member' => $member,
            'cycle' => $cycle,
        ]);
    }

    public function destroy(Request $request): RedirectResponse
    {
        $organization = $request->attributes->get('organization');
        $cycle = $request->attributes->get('cycle');

        (new DestroyCycle(
            cycle: $cycle,
        ))->execute();

        return redirect()->route('organizations.show', [
            'slug' => $organization->slug,
        ]);
    }
}
