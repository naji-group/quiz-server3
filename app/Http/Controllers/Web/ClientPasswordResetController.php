<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ClientPasswordResetController extends Controller
{
    public function showLinkRequestForm()
    {
        $sitedctrlr = new SiteDataController();
        $transarr = $sitedctrlr->FillTransData();
        $defultlang = $transarr['langs']->first();
        $mainarr=$sitedctrlr->FillStaticData();
        $login = $sitedctrlr->getbycode($defultlang->id, ['login']);
    
        return view('site.client.password.forgot-password',[
            'mainarr'=>$mainarr,
          'transarr' => $transarr,
          'lang' =>  $defultlang->code,
          'defultlang' => $defultlang,
          'login' => $login,
         'sitedataCtrlr' => $sitedctrlr,
          'status' => session('status')
        ]);
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::broker('clients')->sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }

    public function showResetForm(Request $request, $token = null)
    {
        $sitedctrlr = new SiteDataController();
        $transarr = $sitedctrlr->FillTransData();
        $defultlang = $transarr['langs']->first();
        $mainarr=$sitedctrlr->FillStaticData();
        $login = $sitedctrlr->getbycode($defultlang->id, ['login','register']);
        return view('site.client.password.reset-password')->with(
            ['token' => $token, 'email' => $request->email,
            'mainarr'=>$mainarr,
            'transarr' => $transarr,
            'lang' =>  $defultlang->code,
            'defultlang' => $defultlang,
            'login' => $login,
           'sitedataCtrlr' => $sitedctrlr,
           ]
        );
    }
   
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::broker('clients')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($client, $password) {
                $client->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );
$lang= $request->only('lang');
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login.client',$lang)->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }
}
