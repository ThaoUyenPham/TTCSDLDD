<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use Illuminate\Support\Facades\Session;
use App\Models\ListPermission;

class CheckAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check())
        {
        
            $showMenu=ListPermission::select('listpermission.id',"listpermission.active_date","listpermission.expri_date")
                ->leftJoin('security as s', 'listpermission.security_id', '=', 's.id')
                ->selectRaw('s.code as codesecurity, s.name as namesecurity')
                ->where('user_id', Auth::user()->id)->where('s.code','super')->get();

            view()->share('showMenu',$showMenu);
            return $next($request);
        }else{
            return redirect()->route('login');
        }
    }
}
