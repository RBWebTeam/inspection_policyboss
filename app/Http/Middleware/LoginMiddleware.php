<?php

namespace App\Http\Middleware;

use Closure;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        (!$request->session()->exists('admin')){
if(!$request->session()->exists('userid')){
            if ($request->ajax()) {
                return response('Unauthorized.',401);
            } else {
                return redirect()->back();
            }
        } 


        return $next($request);

}
    }
}
