<?php

namespace App\Http\Middleware;

use App\Models\Cycle;
use App\Models\Member;
use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckCycle
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $slug = $request->route()->parameter('slug');
        $cycle = (int) $request->route()->parameter('cycle');

        try {
            $cycle = Cycle::whereHas('organization', function ($query) use ($slug): void {
                $query->where('slug', $slug);
            })->where('number', $cycle)->firstOrFail();

            $request->attributes->add(['cycle' => $cycle]);

            return $next($request);
        } catch (ModelNotFoundException) {
            abort(401);
        }
    }
}
