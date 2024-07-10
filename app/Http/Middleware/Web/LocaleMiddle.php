<?php

namespace App\Http\Middleware\Web;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Web\SiteDataController;
class LocaleMiddle
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     $locale = $request->segment(1); 
    //     $sitedctrlr=new SiteDataController();
       

    //     if(empty($locale)) { 
    //         $transarr=$sitedctrlr->FillTransData();
    //         $defultlang=$transarr['langs']->first()->code;
    //         return redirect()->to('/' .$defultlang);
    //     }
    //     if(!in_array($locale, ['en','ar','tr','de'])) {
    //         $transarr=$sitedctrlr->FillTransData();
    //         $defultlang=$transarr['langs']->first()->code; 
    //         $request->segment(1)=$defultlang;
    //         return $next($request);
    //      //    return redirect()->to(route(\Illuminate\Support\Facades\Route::currentRouteName(),$defultlang));
    //        //  route(\Illuminate\Support\Facades\Route::currentRouteName(),['lang' => $defultlang])
    //      }
    //     // if(in_array($locale, ['en','ar','tr','de'])) {
    //     //    // App::setLocale($locale);
    //     //     $request->except(0); 
    //     // }

    //     return $next($request);
       
    // }
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->segment(1); 
       
        if(!in_array($locale, ['admin'])) {
          
            return $next($request);
     
         }
         return redirect()->route('login');
    

       
       
    }
}
