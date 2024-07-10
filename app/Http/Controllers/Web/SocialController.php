<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialModel;
use App\Models\ClientSocial;
 
use App\Http\Requests\Social\StoreSocialRequest;
use App\Http\Requests\Social\UpdateSocialRequest;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $List = SocialModel::get();
        return view('admin.social.show', ['List' => $List]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.social.create' );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSocialRequest $request)
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
        $newObj = new SocialModel();
        $newObj->name = $formdata['name'];
        $newObj->code = $formdata['code'];
        $newObj->link = $formdata['link'];
        $newObj->htmlcode = $formdata['htmlcode'];
         
        $newObj->is_active = isset ($formdata["is_active"]) ? 1 : 0;
        $newObj->save();
  
        
        //    return redirect()->back()->with('success_message','user has been Updated!');
       // return response()->json("ok");
        return redirect()->route('social.index')->with('success', 'تم إضافة المعلومات  بنجاح');
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
        $item = SocialModel::find($id);
       //  return dd($item);
        return view("admin.social.edit", ["itemsocial" => $item ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSocialRequest $request, $id)
    {
        
      //UpdateSocialRequest
  
      //validate
  
      $formdata = $request->all();
    //  return   $formdata['name'];
      $validator = Validator::make(
        $formdata,
        $request->rules(),
        $request->messages()
      );
      if ($validator->fails()) {
  
        return response()->json($validator);
        // return redirect()
        // ->back()
        // ->withErrors($validator)
        // ->withInput();
      } else {      
        SocialModel::find($id)->update([
      'name' => $formdata['name'], 
'code' => $formdata['code'],
//'notes' => $formdata['notes'],
'is_active' => isset ($formdata["is_active"]) ? 1 : 0,
'link' => $formdata['link'],
'htmlcode' => $formdata['htmlcode'],
 
        ]);
  
       
        //    return redirect()->back()->with('success_message','user has been Updated!');
       // return response()->json("ok");
        return redirect()->route('social.index')->with('success', 'تم تعديل المعلومات  بنجاح');
      }
  
  
    }
  

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
         
            $item = SocialModel::find($id);
          if (!( $item  === null)) {
            //delete image
            // $oldimagename =$item->image;
            // $strgCtrlr = new StorageController();
            // $path = $strgCtrlr->path['clients'];
            // Storage::delete("public/" .$path. '/' . $oldimagename);        
            //delete   MediaPost records
            ClientSocial::where('social_id',$id)->delete();
            
            SocialModel::find($id)->delete();
           
            return redirect()->route('social.index')->with('success', 'تم الحذف بنجاح');
          }else{
          //  return redirect()->back();
            return redirect()->route('social.index');
          }
        
    }
}
