<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class IsStudent
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
       /*  $studentRole = Role::where('name', 'student')->first();

        if(Auth::user()->role_id != $studentRole->id){

            return redirect(url('/'));
        }

        return $next($request); */

        if(Auth::user()->role->name == 'student'){

            return $next($request);
        }
        
        return redirect(url('/'));
    }
}
