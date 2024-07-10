<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Language\StoreLanguageRequest;
use App\Http\Requests\Language\UpdateLanguageRequest;
class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $List = Language::get();
        return view('admin.language.show', ['List' => $List]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.language.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLanguageRequest $request)
    {
        $formdata = $request->all();
   // return  $formdata;
    // return redirect()->back()->with('success_message', $formdata);
    $validator = Validator::make(
      $formdata,
      $request->rules(),
      $request->messages()
    );

    if ($validator->fails()) {
      /*
                           return  redirect()->back()->withErrors($validator)
                           ->withInput();
                           */
      // return response()->withErrors($validator)->json();
      return response()->json($validator);

    } else {
          
      $newObj = new Language;
           //reset all to 0
  $isdefault=0;
  if(isset ($formdata["is_default"])){
    $isdefault=1;
    Language::query()->update([       
        'is_default' =>0,
      ]);
  }
      $newObj->code = $formdata['code'];
      $newObj->name = $formdata['name'];    
      $newObj->status = isset ($formdata["status"]) ? 1 : 0;
      $newObj->is_default =$isdefault;
      $newObj->save();

      if ($request->hasFile('image')) {
        $file = $request->file('image');
        $this->storeImage($file, $newObj->id);    
      }

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
        $item = Language::find($id);
 
        //
        return view("admin.language.edit", ["item" => $item]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLanguageRequest $request,$id)
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
      if ($request->hasFile('image')) {
        $file = $request->file('image');
        // $filename= $file->getClientOriginalName();                
        $this->storeImage($file, $id);
      }
      //reset all to 0
  $isdefault=0;
  if(isset ($formdata["is_default"])){
    $isdefault=1;
    Language::query()->update([       
        'is_default' =>0,
      ]);
  }
      Language::find($id)->update([
        //'user_name'=>$formdata['user_name'],
        'code' => $formdata['code'],
        'name' => $formdata['name'],
        'status' => isset ($formdata["status"]) ? 1 : 0,
        'is_default' => $isdefault,
      ]);
  
      return response()->json("ok");
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    
      //delete user
      $item = Language::find($id);
      if (!( $item  === null)) {
           //delete image
        if(!is_null($item ->image)){
          $oldimagename =  $item ->image;
          $strgCtrlr = new StorageController();
          $path = $strgCtrlr->path['languages'];
          Storage::delete("public/" .$path. '/' . $oldimagename);
        }
        
        Language::find($id)->delete();
      }
      return redirect()->route('language.index');
  
    }

    public function storeImage($file, $id)
    {
      $imagemodel = Language::find($id);
      $strgCtrlr = new StorageController();
      $path = $strgCtrlr->path['languages'];
      $oldimage = $imagemodel->image;
      $oldimagename = basename($oldimage);
    //  $oldimagepath = $path . '/' . $oldimagename;
      //save photo
  
      if ($file !== null) {
        //  $filename= rand(10000, 99999).".".$file->getClientOriginalExtension();
        $ext=$file->getClientOriginalExtension();
     //  $filename =  $imagemodel->code . $id . ".webp";
        $filename =  $imagemodel->code . $id .'.'.$ext;
        /*
        $manager = new ImageManager(new Driver());
        $image = $manager->read($file);
        $image = $image->toWebp(75);
        */
        Storage::delete("public/" .$path . '/' . $oldimagename);
/*
        if (!File::isDirectory(Storage::url('/' .$path))) {
          Storage::makeDirectory('public/' . $path);
        }
        */
      //  $image->save(storage_path('app/public') . '/' . $path . '/' . $filename);
        $path = $file->storeAs($path ,$filename,'public');
        //   $url = url('storage/app/public' . '/' . $path . '/' . $filename);
        Language::find($id)->update([
          "image" => $filename
        ]);
      //  Storage::delete("public/" .$path . '/' . $oldimagename);
      }
      return 1;
    }
}
