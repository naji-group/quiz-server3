<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LangPost;
use App\Http\Requests\LangPost\UpdateLangPostRequest;
use Illuminate\Support\Facades\Validator;
class LangPostController extends Controller
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
    public function update(UpdateLangPostRequest $request,$id)
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
           //$id is project_id
           /*
'project_id',
        'lang_id',
        'title_trans',
        'content_trans',
           */
          $lang_id=  $formdata['lang_id'];
          $LangPost = LangPost::updateOrCreate(
            ['post_id' => $id, 'lang_id' =>  $lang_id],
            [
            'title_trans' =>$formdata['title_trans'], 
            'content_trans' =>$formdata['content_trans']
            ]
        );
       return response()->json("ok");
             }
       
        
        
    }

    //category
    public function updatelangcategory(UpdateLangPostRequest $request,$id)
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
           
          $lang_id=  $formdata['lang_id'];
          $LangPost = LangPost::updateOrCreate(
            ['category_id' => $id, 'lang_id' =>  $lang_id],
            [
            'title_trans' =>$formdata['title_trans'], 
            'content_trans' =>$formdata['content_trans']
            ]
        );
       return response()->json("ok");
             }
       
        
        
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
