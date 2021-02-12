<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\App;   

use Closure;
use Illuminate\Http\Request;

class Lang
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
        $lang = $request->Session()->get('lang');

        /* if($lang == null){
            $lang = "en";
        } */
        $lang = $lang ?? "en";

        App::setLocale($lang);

        return $next($request);
    }
}
