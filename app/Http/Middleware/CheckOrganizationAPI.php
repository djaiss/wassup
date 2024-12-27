<?php

namespace App\Http\Middleware;

use App\Models\Member;
use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckOrganizationAPI
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id = $request->route()->parameter('organization');

        try {
            $member = Member::with('organization')
                ->where('organization_id', $id)
                ->where('user_id', Auth::user()->id)
                ->firstOrFail();

            $request->attributes->add(['member' => $member]);
            $request->attributes->add(['organization' => $member->organization]);

            return $next($request);
        } catch (ModelNotFoundException) {
            abort(401, 'There is no organization with this id in your account.');
        }
    }
}
