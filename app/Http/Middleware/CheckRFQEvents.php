<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRFQEvents
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
         $user = \Auth::user();
          $helper = new \App\Helper\Helper();
          $data = $helper->customHeaderFunction() ;
          
        if ((is_array($data) && in_array('RFQ Events', $data)) || ($user && $user->usertype === 'admin')) {
            return $next($request);
        } else {
            return redirect()->route('admin.dashboard');
        }
    }
}
