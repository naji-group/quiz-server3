<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Level;
// use App\Models\Language;
use Illuminate\Support\Str;


use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Level\StoreLevelRequest;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Level::get();

        return view("admin.level.show", [
            "List" => $items,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.level.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLevelRequest $request)
    {
        $formdata = $request->all();
        $validator = Validator::make(
            $formdata,
            $request->rules(),
            $request->messages()
        );

        if ($validator->fails()) {

            return response()->json($validator);
        } else {
            $newObj = new Level();
            $newObj->name = $formdata['name'];
            $newObj->value = $formdata['value'];
            $newObj->answers_count = $formdata['answers_count'];
            $newObj->points = $formdata['points'];
            $newObj->status = isset($formdata["status"]) ? 1 : 0;
            $newObj->save();
            return response()->json("ok");
        }
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
    public function edit($id)
    {
        $item = Level::find($id); 
 
        return view("admin.level.edit", ["item" => $item]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreLevelRequest $request, string $id)
    {
        $formdata = $request->all();
        $validator = Validator::make(
            $formdata,
            $request->rules(),
            $request->messages()
        );
        if ($validator->fails()) {
            return response()->json($validator);

        } else {
           
            Level::find($id)->update([
                'name' => $formdata['name'],
                'value' => $formdata['value'],
                'answers_count' => $formdata['answers_count'],
                'points' => $formdata['points'],
                'status' => isset($formdata["status"]) ? 1 : 0,
            ]);
            return response()->json("ok");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {     
      //delete 
      $item = Level::find($id);
      if (!( $item  === null)) {  
        
        Level::find($id)->delete();
      }
      return redirect()->back();
  
    }
    public function clientlevel( )
    {     
      //delete 
      if(Auth::guard('client')->check())
      $level=
     $client_id= Auth::guard('client')->user()->id;

     // $item = Level::find($id);
      
       
    }
}
