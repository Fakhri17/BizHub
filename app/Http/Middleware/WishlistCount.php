<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\UserFavoriteProduct;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WishlistCount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $userId = Auth::id();
            $wishlistCount = UserFavoriteProduct::where('user_id', $userId)
                                ->where('is_favorite', true)
                                ->count();

            View::share('wishlistCount', $wishlistCount);
        }

        return $next($request);
    }
}
