<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Profile
 *
 * You can modify your profile information here.
 */
class MeController extends Controller
{
    /**
     * Get the information about the logged user.
     *
     * This endpoint gets the information about the logged user.
     *
     * @response 200 {
     *  "id": 4,
     *  "name": "Jessica Jones",
     *  "email": "jessica.jones@gmail.com"
     * }
     */
    public function show(Request $request): JsonResponse
    {
        $response = [
            'id' => $request->user()->id,
            'name' => $request->user()->name,
            'email' => $request->user()->email,
        ];

        return response()->json($response);
    }
}
