<?php

namespace App\Http\Middleware\Web;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
 

class AdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $rolesstring): Response
    {
        
        $roles= explode('-',$rolesstring);
        /*
        dump($roles);
        die();
        */
        if (Auth::check()) {
            $user_role=Auth::user()->role;
            foreach($roles as $role){
                if ($user_role==$role){
                return $next($request);
                }
                }
/*
            if (Auth::user()->role == 'admin') {
                return $next($request);
            } 
            */
           // else {
                return redirect('/');              
           // }
        } else {
            return redirect()->route('login');
        }
        //   return  redirect()->intended('login');
        // return redirect('/dashboard');
    }
}

