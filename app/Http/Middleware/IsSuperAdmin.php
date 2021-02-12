<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class IsSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
       /*  $superAdminRole = Role::where('name', 'superadmin')->first();

        if(Auth::user()->role_id != $superAdminRole->id){

            return redirect(url('/'));
        }

        return $next($request); */

        if(Auth::user()->role->name == 'superadmin'){

            return $next($request);
        }
        
        return redirect(url('/'));
    }
}
