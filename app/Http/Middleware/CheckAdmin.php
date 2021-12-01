<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
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
        $loggedin = auth()->guard('sanctum')->user()->exists();
        $pid = auth()->guard('sanctum')->user()->permission_id;

        if($loggedin && $pid == 1){
            return $next($request);
        }
        return response([
            'message' => 'Nie posiadasz wystarczających uprawnień',
        ]);
    }
}
