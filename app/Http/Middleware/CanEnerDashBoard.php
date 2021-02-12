<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class CanEnerDashBoard
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
       
        /* $adminRole = Role::where('name', 'admin')->first(); */

        $roleName = Auth::user()->role->name;

        if($roleName == 'admin' or $roleName == 'superadmin'){                   //so students can't enter dashboard

            return $next($request);
        }
        
        return redirect(url('/'));
    }
}
