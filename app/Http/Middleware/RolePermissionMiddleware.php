<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;
use DB;
use App\Models\ListPermission;

class RolePermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    private $roles;

    public function __construct(...$roles)
    {
        $this->roles = $roles;
    }

    public function handle($request, Closure $next, ...$roles)
    {
        if (empty($roles)) {
            return  redirect()->route("notpermission");
        }else{
            if(Auth::check())
            {
                $showMenu=ListPermission::select('listpermission.id',"listpermission.active_date","listpermission.expri_date")
                    ->leftJoin('security as s', 'listpermission.security_id', '=', 's.id')
                    ->selectRaw('s.code as codesecurity, s.name as namesecurity')
                    ->where('user_id', Auth::user()->id)->where('s.code','super')->get();
                 view()->share('showMenu',$showMenu);
                if ($this->hasAnyRole(Auth::user()->id, $roles)) {
                    // Session::push("check",$roles);
                    return $next($request);
                }
                // return $next($request);
            }else{
                return redirect()->route('login');
            }
        }
        return redirect()->route("notpermission");
    }

    private function hasAnyRole($userId, $roles)
    {
        $cacheKey = 'user_roles_' . $userId;
        
        // Thời gian cache (phút)
        $cacheTTL = 60;

       $userRoles= Cache::remember($cacheKey, $cacheTTL, function() use ($userId) {
             return  ListPermission::select('listpermission.id',"listpermission.active_date","listpermission.expri_date")
                ->leftJoin('security as s', 'listpermission.security_id', '=', 's.id')
                ->selectRaw('s.code as codesecurity, s.name as namesecurity')
                ->where('user_id', $userId)->pluck('codesecurity')->toArray();
        });
        return !empty(array_intersect($roles, $userRoles));
    }
}
