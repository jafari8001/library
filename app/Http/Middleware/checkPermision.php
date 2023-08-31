<?php

namespace App\Http\Middleware;

use App\Exceptions\PermisionError;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class checkPermision
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $uri = Route::getFacadeRoot()->current()->uri();
        $user = Auth::user()->id;
        $query = User::where("users.id", $user)
        ->join("role_user", "user_id", "users.id")
        ->join("roles", "roles.id", "role_user.user_id")
        ->join("action_role", "action_role.role_id", "roles.id")
        ->join("actions", "actions.id", "action_role.action_id")
        ->where("route_name", $uri)->first();
        if ($query) {
            return $next($request);
        }
        throw new PermisionError();
        
    }
}
