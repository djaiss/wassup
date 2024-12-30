<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CycleResource;
use App\Models\Cycle;
use App\Models\Organization;
use Illuminate\Http\Request;

/**
 * @group Organizations
 *
 * @subgroup Cycles
 */
class ActiveCycleController extends Controller
{
    /**
     * Retrieve the current active cycle.
     *
     * Retrieves the current active cycle for the organization, if there is one.
     * If there is no active cycle, it will return an empty response.
     *
     * @urlParam organization required The id of the organization. Example: 1
     *
     * @response 200 {
     *   "id": 1,
     *   "object": "cycle",
     *   "number": 1,
     *   "description": "This is a description of the cycle.",
     *   "started_at": 1514764800,
     *   "ended_at": 1514764800,
     *   "is_active": true,
     *   "is_public": true,
     *   "created_at": 1514764800,
     *   "updated_at": 1514764800,
     * }
     *
     * @responseField id Unique identifier for the object.
     * @responseField object The object type. Always "cycle".
     * @responseField number The number of the cycle.
     * @responseField description The description of the cycle.
     * @responseField started_at The start date of the cycle. Represented as a Unix timestamp.
     * @responseField ended_at The end date of the cycle. Represented as a Unix timestamp.
     * @responseField is_active Whether the cycle is active.
     * @responseField is_public Whether the cycle is public.
     * @responseField created_at The date the object was created. Represented as a Unix timestamp.
     * @responseField updated_at The date the object was last updated. Represented as a Unix timestamp.
     */
    public function show(Request $request): CycleResource|array
    {
        $organization = $request->attributes->get('organization');

        $cycle = $organization->cycles()
            ->where('is_active', true)
            ->orderBy('number', 'desc')
            ->first();

        if (! $cycle) {
            return [];
        }

        return new CycleResource($cycle);
    }
}
