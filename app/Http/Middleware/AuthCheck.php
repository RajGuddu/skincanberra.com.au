<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!$request->session()->has('admindata')){
            $msg = '';
            if($request->is('admin/*')){
                $msg = 'You must be loged in.';
            }
            return redirect()->to('/'.ADMIN)->with('err', $msg);
        }else{
            return $next($request);
        }
    }
}
