<?php

namespace App\Http\Controllers\Api;

use App\Actions\CreateOrganization;
use App\Actions\DestroyOrganization;
use App\Actions\UpdateOrganization;
use App\Exceptions\OrganizationMismatchException;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrganizationCollection;
use App\Http\Resources\OrganizationResource;
use App\Models\Organization;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @group Organizations
 *
 * @subgroup Cycles
 *
 * Cycles represent a period of time in which people can set goals and check-in.
 *
 * Cycles are managed by administrators.
 *
 * Cycles can have a public URL. This URL is used to tell the world about the
 * cycle.
 */
class CycleController extends Controller
{
    /**
     * Create a cycle.
     *
     * @bodyParam name string required The name of the cycle. Max 255 characters. Example: Cycle 1
     *
     * @response 201 {
     *  "id": 1,
     *  "object": "organization",
     *  "name": "Acme, Inc.",
     *  "slug": "acme-inc",
     *  "code": "ACME1234567890",
     *  "created_at": 1514764800,
     *  "updated_at": 1514764800,
     * }
     *
     * @responseField id Unique identifier for the object.
     * @responseField object The object type. Always "organization".
     * @responseField name The name of the organization.
     * @responseField slug The slug of the organization.
     * @responseField code The code of the organization.
     * @responseField created_at The date the object was created. Represented as a Unix timestamp.
     * @responseField updated_at The date the object was last updated. Represented as a Unix timestamp.
     */
    public function create(Request $request): \App\Http\Resources\OrganizationResource
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $organization = (new CreateOrganization(
            name: $validated['name'],
        ))->execute();

        return new OrganizationResource($organization);
    }

    /**
     * Update an organization.
     *
     * Only administrators can update an organization.
     * Changing the name of the organization will change the slug and therfore,
     * all the URLs that were previously created for this organization will be
     * invalidated.
     *
     * @urlParam organization required The id of the organization. Example: 1
     *
     * @bodyParam name string required The name of the organization. Max 255 characters. Example: Acme, Inc.
     *
     * @response 200 {
     *  "id": 1,
     *  "object": "organization",
     *  "name": "Acme, Inc.",
     *  "slug": "acme-inc",
     *  "code": "ACME1234567890",
     *  "created_at": 1514764800,
     *  "updated_at": 1514764800,
     * }
     *
     * @responseField id Unique identifier for the object.
     * @responseField object The object type. Always "organization".
     * @responseField name The name of the organization.
     * @responseField slug The slug of the organization.
     * @responseField code The code of the organization.
     * @responseField created_at The date the object was created. Represented as a Unix timestamp.
     * @responseField updated_at The date the object was last updated. Represented as a Unix timestamp.
     */
    public function update(Request $request): \App\Http\Resources\OrganizationResource
    {
        $id = $request->route()->parameter('organization');

        try {
            $organization = Organization::query()
                ->whereHas('members', function ($query): void {
                    $query->where('user_id', Auth::id());
                })->findOrFail($id);
        } catch (ModelNotFoundException) {
            abort(401, 'There is no organization with this id in your account.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            $organization = (new UpdateOrganization(
                user: Auth::user(),
                organization: $organization,
                name: $validated['name'],
            ))->execute();
        } catch (OrganizationMismatchException) {
            abort(401, 'You are not an administrator of this organization.');
        }

        return new OrganizationResource($organization);
    }

    /**
     * Delete an organization.
     *
     * Only administrators can delete an organization.
     *
     * @urlParam organization required The id of the organization. Example: 1
     *
     * @response 200 {
     *  "status": "success"
     * }
     */
    public function destroy(Request $request): JsonResponse
    {
        $id = $request->route()->parameter('organization');

        try {
            $organization = Organization::query()
                ->whereHas('members', function ($query): void {
                    $query->where('user_id', Auth::id());
                })->findOrFail($id);
        } catch (ModelNotFoundException) {
            abort(401, 'There is no organization with this id in your account.');
        }

        try {
            (new DestroyOrganization(
                user: Auth::user(),
                organization: $organization,
            ))->execute();
        } catch (OrganizationMismatchException) {
            abort(401, 'You are not an administrator of this organization.');
        }

        return response()->json([
            'status' => 'success',
        ], 200);
    }

    /**
     * Retrieve an organization.
     *
     * @urlParam organization required The id of the organization. Example: 1
     *
     * @response 200 {
     *   "id": 1,
     *   "object": "organization",
     *   "name": "Acme, Inc.",
     *   "slug": "acme-inc",
     *   "code": "ACME1234567890",
     *   "created_at": 1514764800,
     *   "updated_at": 1514764800
     * }
     *
     * @responseField id Unique identifier for the object.
     * @responseField object The object type. Always "organization".
     * @responseField name The name of the organization.
     * @responseField slug The slug of the organization.
     * @responseField code The code of the organization.
     * @responseField created_at The date the object was created. Represented as a Unix timestamp.
     * @responseField updated_at The date the object was last updated. Represented as a Unix timestamp.
     */
    public function show(Request $request): \App\Http\Resources\OrganizationResource
    {
        $id = $request->route()->parameter('organization');

        try {
            $organization = Organization::query()
                ->whereHas('members', function ($query): void {
                    $query->where('user_id', Auth::id());
                })->findOrFail($id);
        } catch (ModelNotFoundException) {
            abort(401, 'There is no organization with this id in your account.');
        }

        return new OrganizationResource($organization);
    }

    /**
     * List all organizations.
     *
     * This API call returns a paginated collection of organizations that contains
     * 15 items per page.
     *
     * @response 200 {"data": [{
     *  "id": 1,
     *  "object": "organization",
     *  "name": "Acme, Inc.",
     *  "slug": "acme-inc",
     *  "code": "ACME1234567890",
     *  "created_at": 1514764800,
     *  "updated_at": 1514764800,
     * }, {
     *  "id": 2,
     *  "object": "organization",
     *  "name": "Acme, Inc.",
     *  "slug": "acme-inc",
     *  "code": "ACME1234567890",
     *  "created_at": 1514764800,
     *  "updated_at": 1514764800,
     * }],
     * "links": {
     *   "first": "http://wassup.test/api/organizations?page=1",
     *   "last": "http://wassup.test/api/organizations?page=1",
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
     *        "url": "http://wassup.test/api/organizations?page=1",
     *        "label": "1",
     *        "active": true
     *      },
     *      {
     *        "url": null,
     *        "label": "Next &raquo;",
     *        "active": false
     *      }
     *    ],
     *    "path": "http://wassup.test/api/organizations",
     *    "per_page": 15,
     *    "to": 1,
     *    "total": 1
     *  }
     *
     * @responseField id Unique identifier for the object.
     * @responseField object The object type. Always "organization".
     * @responseField name The name of the organization.
     * @responseField slug The slug of the organization.
     * @responseField code The code of the organization.
     * @responseField created_at The date the object was created. Represented as a Unix timestamp.
     * @responseField updated_at The date the object was last updated. Represented as a Unix timestamp.
     */
    public function index(Request $request): OrganizationCollection
    {
        $organizations = Organization::query()
            ->whereHas('members', function ($query): void {
                $query->where('user_id', Auth::id());
            })
            ->paginate();

        return new OrganizationCollection($organizations);
    }
}
