<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next, ...$allowedTypes): Response
    {
        $user = auth()->user();

        $userType = $user->type;

        // ✅ Permission check
        if (!in_array($userType, $allowedTypes)) {
            return response()->json([
                'success' => false,
                'message' => 'You are not allowed to access this module'
            ], 403);
        }

        // ✅ Access granted
        return $next($request);
    }












    // public function handle(Request $request, Closure $next, ...$allowedRoutes): Response
    // {
    //     $user = Auth::user();

    //     if (!$user) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Unauthenticated'
    //         ], 401);
    //     }

    //     $userType = $user->type;
    //     $currentRoute = $request->route()->getName();

    //     /**
    //      * Permission Map (ONE PLACE CONTROL)
    //      */
    //     $permissions = [
    //         'super_admin' => ['*'],

    //         'admin' => [
    //             '*',
    //             '!transactions.*'
    //         ],

    //         'accountant' => [
    //             'transactions.*'
    //         ],

    //         'recruiter' => [
    //             '*',
    //             '!employees.*',
    //             '!transactions.*',
    //             '!designations.*'
    //         ],
    //     ];

    //     if (!isset($permissions[$userType])) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Invalid user role'
    //         ], 403);
    //     }

    //     if ($this->hasAccess($permissions[$userType], $currentRoute)) {
    //         return $next($request);
    //     }

    //     return response()->json([
    //         'success' => false,
    //         'message' => 'You do not have permission to access this resource'
    //     ], 403);
    // }

    // /**
    //  * Route permission checker
    //  */
    // protected function hasAccess(array $rules, string $routeName): bool
    // {
    //     // Full access
    //     if (in_array('*', $rules)) {
    //         foreach ($rules as $rule) {
    //             if (str_starts_with($rule, '!') &&
    //                 fnmatch(substr($rule, 1), $routeName)) {
    //                 return false;
    //             }
    //         }
    //         return true;
    //     }

    //     // Limited access
    //     foreach ($rules as $rule) {
    //         if (fnmatch($rule, $routeName)) {
    //             return true;
    //         }
    //     }

    //     return false;
    // }

}
