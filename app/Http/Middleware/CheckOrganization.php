<?php

namespace App\Http\Middleware;

use App\Models\Member;
use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckOrganization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $slug = $request->route()->parameter('slug');

        try {
            $member = Member::with('organization')->whereHas('organization', function ($query) use ($slug): void {
                $query->where('slug', $slug);
            })->where('user_id', auth()->user()->id)->firstOrFail();

            $request->attributes->add(['member' => $member]);
            $request->attributes->add(['organization' => $member->organization]);

            return $next($request);
        } catch (ModelNotFoundException) {
            abort(401);
        }
    }
}
