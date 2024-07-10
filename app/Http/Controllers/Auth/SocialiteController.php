<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
class SocialiteController extends Controller
{
    public function loginSocial(Request $request): RedirectResponse
    {
        $this->validateProvider($request);
 
        return Socialite::driver('facebook')->redirect();
    }
 
    public function callbackSocial(Request $request)
    {
        $this->validateProvider($request);
 
        $response = Socialite::driver('facebook')->user();
 
        $user = Client::updateOrCreate(
            ['email' => $response->getEmail()],
            [ 
             'password' => Str::password(),
             'name' => $response->getName() ?? $response->getNickname,
             'facebook' . '_id' => $response->getId(),
        ]);
       // $data = ['facebook' . '_id' => $response->getId()];
 
        if ($user->wasRecentlyCreated) {
            //$data['name'] = $response->getName() ?? $response->getNickname();
 
            event(new Registered($user));
        }
 
      //  $user->update($data);
 
        Auth::guard('client')->login($user, remember: true);
 
        return redirect()->intended(RouteServiceProvider::HOME);
    }
 
    protected function validateProvider(Request $request): array
    {
        return $this->getValidationFactory()->make(
            $request->route()->parameters(),
            ['provider' => 'in:facebook']
        )->validate();
    }
}
