<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
 
use Illuminate\Routing\Router;
use App\Models\Client;
use Illuminate\Support\Facades\DB;
//use Image;

use File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Redirector;
//use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Http\Requests\Api\Client\StoreClientRequest;
 
use Illuminate\Support\Facades\Auth;//temp
use JWTAuth;
//use Tymon\JWTAuth\Facades\JWTAuth;
class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$users = JWTAuth::parseToken()->authenticate();
       $users = DB::table('clients')->get();
        // return view('admin.user.showusers',['users' => $users]); 
    // $atype=  Auth::user() ;
    // $user=auth('api_clients')->user();
   //  $user= Auth::guard( )->user();
      // $atype=Auth::check();
        return response()->json( $users );
    //  return response()->json(   $atype );
    }
    public function getloguser()
    {
        //$users = JWTAuth::parseToken()->authenticate();
       
        // return view('admin.user.showusers',['users' => $users]); 
    // $atype=  Auth::user() ;
    //  $userc=auth('api_clients')->user();
    //  $user=auth('api')->user();
    // $userw=auth()->user();
     if (auth()->user() instanceof \App\Models\User) {
        // عمليات خاصة بـ User Model
        $customValue = 'User';
    }
    elseif(auth()->user() instanceof Client){
        $customValue = 'Client';
    }else{
        $customValue = 'No auth';
    }
      // $atype=Auth::check();
        return response()->json( 
            ['user-type' => $customValue 
        ]);
    //  return response()->json(   $atype );
    }
    public function addUser(Client $newUClient)
    {
        $newUClient->save();
        return $newUClient;
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
