<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MemberAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!$request->session()->has('memberLogin')){
            /*$msg = '';
            if($request->is('admin/*')){
                $msg = 'You must be loged in.';
            }*/
            return redirect()->to('/member-login')->with('err', 'You must be login.');
        }else{
            return $next($request);
        }
    }
}
