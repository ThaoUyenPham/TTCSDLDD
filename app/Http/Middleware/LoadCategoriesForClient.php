<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Category;
use App\Models\TopAds;
use App\Models\Ads;
use Illuminate\Support\Facades\Auth;

class LoadCategoriesForClient
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next): Response
    {
      
            // Load categories từ cơ sở dữ liệu
            $categories=Category::where('category.level', 1)
            ->where(function($query) {
                $query->whereNull('is_block')
                    ->orWhere('is_block', false);
            })->where(function($query) {
                $query->whereNull('is_delete')
                    ->orWhere('is_delete', false);
            })->get();
            for ($i=0; $i < count($categories); $i++) { 
                $categories[$i]['children']=Category::where('category.level', 2)
                ->where(function($query) {
                    $query->whereNull('is_block')
                        ->orWhere('is_block', false);
                })->where(function($query) {
                    $query->whereNull('is_delete')
                        ->orWhere('is_delete', false);
                })->where('parent_id', $categories[$i]->id)->get();
            }
            $afteruserlogin=0;
            if(Auth::check())
            {
                $afteruserlogin = Auth::user();
                
            }
            $topads=TopAds::where(function($query) {
                $query->whereNull('is_delete')
                    ->orWhere('is_delete', false);
            })
            ->where(function($query) {
                $query->whereNull('is_block')
                    ->orWhere('is_block', false);
            })->get();
            $ads=Ads::where(function($query) {
                $query->whereNull('is_block')
                    ->orWhere('is_block', false);
            })->where(function($query) {
                $query->whereNull('is_delete')
                    ->orWhere('is_delete', false);
            })->get();
            // Chia sẻ categories với tất cả các view
            view()->share('adsload', $ads);
            view()->share('categoriesload', $categories);
            view()->share('topadsload', $topads);
            view()->share('afteruserlogin', $afteruserlogin);
    
        return $next($request);
    }
}
