<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class PasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function forgotpass() 
    {

        $sitedctrlr = new SiteDataController();
        $transarr = $sitedctrlr->FillTransData();
        $defultlang = $transarr['langs']->first();
        $mainarr=$sitedctrlr->FillStaticData();
        $login = $sitedctrlr->getbycode($defultlang->id, ['login']);
    
        return view('site.client.password.forgot-password', [
            'mainarr'=>$mainarr,
          'transarr' => $transarr,
          'lang' =>  $defultlang->code,
          'defultlang' => $defultlang,
          'login' => $login,
          'sitedataCtrlr' => $sitedctrlr,
          'status' => session('status')
        ]);
      
       // return view("site.client.password.forgot-password", ['status' => session('status'),]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
