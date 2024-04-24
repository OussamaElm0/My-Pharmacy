<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use function Webmozart\Assert\Tests\StaticAnalysis\inArray;

class IsAdminOrSuperUser
{
    public function handle(Request $request, Closure $next)
    {
        // Check if user is authenticated
        if ($request->user() && in_array($request->user()->role->name ,['Superuser','Administrator'])) {
            return $next($request);
        }

        // If not admin or superuser, redirect or return error response
        return abort(403, 'Unauthorized action.');
    }
}
