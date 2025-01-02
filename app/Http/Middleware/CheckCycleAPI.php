<?php

namespace App\Http\Middleware;

use App\Models\Cycle;
use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckCycleAPI
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id = $request->route()->parameter('organization');
        $cycle = (int) $request->route()->parameter('cycle');

        try {
            $cycle = Cycle::with('organization')
                ->where('organization_id', $id)
                ->where('number', $cycle)
                ->firstOrFail();

            $request->attributes->add(['cycle' => $cycle]);

            return $next($request);
        } catch (ModelNotFoundException) {
            abort(401);
        }
    }
}
