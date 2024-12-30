<?php

namespace App\Http\Controllers\Api;

use App\Actions\CreateCycle;
use App\Actions\CreateOrganization;
use App\Actions\DestroyCycle;
use App\Actions\DestroyOrganization;
use App\Actions\UpdateCycle;
use App\Actions\UpdateOrganization;
use App\Exceptions\OrganizationMismatchException;
use App\Http\Controllers\Controller;
use App\Http\Resources\CycleCollection;
use App\Http\Resources\CycleResource;
use App\Http\Resources\OrganizationCollection;
use App\Http\Resources\OrganizationResource;
use App\Models\Cycle;
use App\Models\Organization;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @group Organizations
 *
 * @subgroup Cycles
 */
class CycleController extends Controller
{
    /**
     * Create a cycle.
     *
     * Cycles represent a period of time in which people can set goals and check-in.
     *
     * Cycles are managed by administrators.
     *
     * Cycles can have a public URL. This URL is used to tell the world about the
     * cycle.
     *
     * @bodyParam number integer required The number of the cycle. Example: 1
     * @bodyParam description string required The description of the cycle. Example: This is a description of the cycle.
     * @bodyParam started_at string The start date of the cycle, in ISO 8601 format (YYYY-MM-DD). Example: 2024-01-01
     * @bodyParam ended_at string The end date of the cycle, in ISO 8601 format (YYYY-MM-DD). Example: 2024-01-01
     * @bodyParam is_active boolean Whether the cycle is active. Example: true
     * @bodyParam is_public boolean Whether the cycle is public. Example: true
     *
     * @response 201 {
     *  "id": 1,
     *  "object": "cycle",
     *  "number": 1,
     *  "description": "This is a description of the cycle.",
     *  "started_at": 1514764800,
     *  "ended_at": 1514764800,
     *  "is_active": true,
     *  "is_public": true,
     *  "created_at": 1514764800,
     *  "updated_at": 1514764800,
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
    public function create(Request $request): CycleResource
    {
        $organization = $request->attributes->get('organization');

        $validated = $request->validate([
            'number' => 'required|integer|min:1',
            'description' => 'required|string|max:4294967295',
            'started_at' => 'required|string',
            'ended_at' => 'required|string',
            'is_active' => 'required|boolean',
            'is_public' => 'required|boolean',
        ]);

        $cycle = (new CreateCycle(
            user: Auth::user(),
            organization: $organization,
            number: $validated['number'],
            description: $validated['description'],
            startedAt: Carbon::parse($validated['started_at']),
            endedAt: Carbon::parse($validated['ended_at']),
            isActive: $validated['is_active'],
            isPublic: $validated['is_public'],
        ))->execute();

        return new CycleResource($cycle);
    }

    /**
     * Update a cycle.
     *
     * Only administrators can update a cycle.
     *
     * @urlParam organization required The id of the organization. Example: 1
     * @urlParam cycle required The number of the cycle. Please note that this is not the id of the cycle. Example: 1
     *
     * @bodyParam number integer The number of the cycle. Example: 1
     * @bodyParam description string required The description of the cycle. Max 4294967295 characters. Example: This is a description of the cycle.
     * @bodyParam started_at string The start date of the cycle, in ISO 8601 format (YYYY-MM-DD). Example: 2024-01-01
     * @bodyParam ended_at string The end date of the cycle, in ISO 8601 format (YYYY-MM-DD). Example: 2024-01-01
     * @bodyParam is_active boolean Whether the cycle is active. Example: true
     * @bodyParam is_public boolean Whether the cycle is public. Example: true
     *
     * @response 200 {
     *  "id": 1,
     *  "object": "cycle",
     *  "number": 1,
     *  "description": "This is a description of the cycle.",
     *  "started_at": 1514764800,
     *  "ended_at": 1514764800,
     *  "is_active": true,
     *  "is_public": true,
     *  "created_at": 1514764800,
     *  "updated_at": 1514764800,
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
    public function update(Request $request): CycleResource
    {
        $cycle = $request->attributes->get('cycle');

        $validated = $request->validate([
            'number' => 'required|integer|min:1',
            'description' => 'required|string|max:4294967295',
            'started_at' => 'required|string',
            'ended_at' => 'required|string',
            'is_active' => 'required|boolean',
            'is_public' => 'required|boolean',
        ]);

        try {
            $cycle = (new UpdateCycle(
                user: Auth::user(),
                cycle: $cycle,
                description: $validated['description'],
                number: $validated['number'],
                startedAt: Carbon::parse($validated['started_at']),
                endedAt: Carbon::parse($validated['ended_at']),
                isActive: $validated['is_active'],
                isPublic: $validated['is_public'],
            ))->execute();
        } catch (OrganizationMismatchException) {
            abort(401, 'You are not an administrator of this organization.');
        }

        return new CycleResource($cycle);
    }

    /**
     * Delete a cycle.
     *
     * Only administrators can delete a cycle.
     *
     * @urlParam organization required The id of the organization. Example: 1
     * @urlParam cycle required The number of the cycle. Please note that this is not the id of the cycle. Example: 1
     *
     * @response 200 {
     *  "status": "success"
     * }
     */
    public function destroy(Request $request): JsonResponse
    {
        $cycle = $request->attributes->get('cycle');

        try {
            (new DestroyCycle(
                user: Auth::user(),
                cycle: $cycle,
            ))->execute();
        } catch (OrganizationMismatchException) {
            abort(401, 'You are not an administrator of this organization.');
        }

        return response()->json([
            'status' => 'success',
        ], 200);
    }

    /**
     * Retrieve a cycle.
     *
     * @urlParam organization required The id of the organization. Example: 1
     * @urlParam cycle required The number of the cycle. Please note that this is not the id of the cycle. Example: 1
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
    public function show(Request $request): CycleResource
    {
        $cycle = $request->attributes->get('cycle');

        return new CycleResource($cycle);
    }

    /**
     * List all cycles.
     *
     * This API call returns a paginated collection of cycles that contains
     * 15 items per page.
     *
     * @response 200 {"data": [{
     *  "id": 1,
     *  "object": "cycle",
     *  "number": 1,
     *  "description": "This is a description of the cycle.",
     *  "started_at": 1514764800,
     *  "ended_at": 1514764800,
     *  "is_active": true,
     *  "is_public": true,
     *  "created_at": 1514764800,
     *  "updated_at": 1514764800,
     * }, {
     *  "id": 2,
     *  "object": "cycle",
     *  "number": 2,
     *  "description": "This is a description of the cycle.",
     *  "started_at": 1514764800,
     *  "ended_at": 1514764800,
     *  "is_active": true,
     *  "is_public": true,
     *  "created_at": 1514764800,
     *  "updated_at": 1514764800,
     * }],
     * "links": {
     *   "first": "http://wassup.test/api/organizations/1/cycles?page=1",
     *   "last": "http://wassup.test/api/organizations/1/cycles?page=1",
     *   "prev": null,
     *   "next": null
     *  },
     *  "meta": {
     *    "current_page": 1,
     *    "from": 1,
     *    "last_page": 1,
     *    "links": [
     *      {
     *        "url": null,
     *        "label": "&laquo; Previous",
     *        "active": false
     *      },
     *      {
     *        "url": "http://wassup.test/api/organizations/1/cycles?page=1",
     *        "label": "1",
     *        "active": true
     *      },
     *      {
     *        "url": null,
     *        "label": "Next &raquo;",
     *        "active": false
     *      }
     *    ],
     *    "path": "http://wassup.test/api/organizations/1/cycles",
     *    "per_page": 15,
     *    "to": 1,
     *    "total": 1
     *  }
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
    public function index(Request $request): CycleCollection
    {
        $organization = $request->attributes->get('organization');

        $cycles = Cycle::where('organization_id', $organization->id)
            ->paginate();

        return new CycleCollection($cycles);
    }
}
