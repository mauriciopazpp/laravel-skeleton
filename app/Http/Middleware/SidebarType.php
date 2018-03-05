<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Session;

class SidebarType
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
        if(!Auth::check())
            return $next($request);

        $request['sidebar'] = '';
        if(Session::has('position') and Session::get('position') == "false")
            $request['sidebar'] = 'sidebar-collapse';            
        
        return $next($request);
    }
}