<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use TypiCMS\Modules\Members\Models\Member;
use Illuminate\Support\Facades\Session;

class MemberMiddleware
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
        if(!Member::check()){
            return redirect()->route(app()->getLocale().'::member.index');
        }
        if(Member::checkIsRead()){
            return $next($request);
        }else{
            return redirect()->route(app()->getLocale().'::member.term');
        }
    }
}
