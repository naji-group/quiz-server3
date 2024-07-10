<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        /*
        $path = 'images/users';
        $url =url( Storage::url($path)).'/'.Auth::user()->image;
        session(['fullpathimg' =>  $url ]);
        */
        $request->session()->regenerate();
//new code
if(Auth::guard('web')){
    return redirect()->intended(RouteServiceProvider::HOME);
}else if(Auth::guard('client')){
    return redirect()->intended(Route('mymessages',false));
}else{
    return redirect('/');
}
 
//end new code
     //   return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
       // Auth::guard('client')->logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
