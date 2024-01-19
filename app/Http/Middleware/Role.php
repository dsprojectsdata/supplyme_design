<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, $role)
    {
          $user = \Auth::user();
          $helper = new \App\Helper\Helper();
          $data = $helper->customHeaderFunction() ;
            if ((is_array($data) && (
                in_array($role, $data) 
            )) || ($user && $user->usertype === 'admin')) {
                return $next($request);
            } else {
                return redirect()->route('admin.dashboard')->with('success','You are not access '.$role.' page ');
            }
        
    }
        
}
