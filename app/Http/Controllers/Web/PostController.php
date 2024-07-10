<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\LangPost;
use App\Models\MediaPost;
use App\Models\Mediastore;
use App\Models\Post;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Requests\Post\UpdateFooterRequest;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Controllers\Web\MediaStoreController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

//use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\JsonResponse;
use Pion\Laravel\ChunkUpload\Exceptions\UploadFailedException;
use Storage;

use Illuminate\Http\UploadedFile;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;
use Pion\Laravel\ChunkUpload\Handler\AbstractHandler;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

use  App\Http\Controllers\Web\StorageController;

class PostController extends Controller
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
    
    
    }
    public function createwithcatid($id)
    {
        $item=Category::find($id);
        return view('admin.post.create', ["category" => $item]);
    }
    public function storepost(StorePostRequest $request)
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

        $tmpslug="";
        // if ($formdata["slug"] == "" || empty($formdata["slug"])) {
            $tmpslug = $formdata["title"];
        // } else {
        //     $tmpslug = $formdata["slug"];
        // }
        $promodel=Post::where('slug', $tmpslug )->first();
        if (!is_null($promodel)) {
            // error
           return response()->json([
             "errors" =>  ["slug" => [__('messages.this field exist',[],'en')]]          
           ], 422);      
        
         } else{        
            
          $newObj = new Post;
         
          $newObj->title = $formdata['title'];
          $newObj->category_id = $formdata['category_id'];
          $newObj->slug =Str::slug($tmpslug); 
         // $newObj->metakey = $formdata['metakey'];   
          $newObj->status = isset ($formdata["status"]) ? 1 : 0;
        
          $newObj->save();   
    
          return response()->json("ok");

         }

    }
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
    public function edit($id)
    {
        $item = Post::with(['category',
            'mediaposts' => function ($q) use ($id) {
                $q->with('mediastore');
            }
        ])->find($id);
        $lang_list = Language::orderByDesc('is_default')->with(
            [
                'langposts' => function ($q) use ($id) {
                    $q->where('post_id', $id);
                }
            ]
        )->get();
        //
        //   return $item;
        return view("admin.design.section.footer.edit", ["item" => $item, 'lang_list' => $lang_list]);
    }
    public function editfooter($id)
    {
        $item = Post::with([
            'mediaposts' => function ($q) use ($id) {
                $q->with('mediastore');
            }
        ])->find($id);
        $lang_list = Language::orderByDesc('is_default')->with(
            [
                'langposts' => function ($q) use ($id) {
                    $q->where('post_id', $id);
                }
            ]
        )->get();
        //
        //   return $item;
        return view("admin.design.section.footer.edit", ["item" => $item, 'lang_list' => $lang_list]);
    }

    public function editpost($id)
    {
        $item = Post::with([
            'mediaposts' => function ($q) use ($id) {
                $q->with('mediastore');
            }
        ])->find($id);
        $lang_list = Language::orderByDesc('is_default')->with(
            [
                'langposts' => function ($q) use ($id) {
                    $q->where('post_id', $id);
                }
            ]
        )->get();
        //
        //   return $item;
        return view("admin.post.edit", ["item" => $item, 'lang_list' => $lang_list]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFooterRequest $request,$id)
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
        //check if slug exist
        $tmpslug="";
        if ($formdata["slug"] == "" || empty($formdata["slug"])) {
            $tmpslug = $formdata["title"];
        } else {
            $tmpslug = $formdata["slug"];
        }
        $promodel=Post::where('slug', $tmpslug )->whereNot('id',$id)->first();
        if (!is_null($promodel)) {
            // error
           return response()->json([
             "errors" =>  ["slug" => [__('messages.this field exist',[],'en')]]          
           ], 422);      
        
         } else{
 
 
   Post::find($id)->update([
     //'user_name'=>$formdata['user_name'],
     'title' => $formdata['title'],
     'metakey' => $formdata['metakey'],
     'slug' =>Str::slug($tmpslug),
   
     'status' => isset ($formdata["status"]) ? 1 : 0,      
   ]);

   return response()->json("ok");
         }
   
    }
    }
    public function updatepost(UpdateFooterRequest $request,$id)
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
        //check if slug exist
        $tmpslug="";
      //  if ($formdata["slug"] == "" || empty($formdata["slug"])) {
            $tmpslug = $formdata["title"];
        // } else {
        //     $tmpslug = $formdata["slug"];
        // }
        $promodel=Post::where('slug', $tmpslug )->whereNot('id',$id)->first();
        if (!is_null($promodel)) {
            // error
           return response()->json([
             "errors" =>  ["slug" => [__('messages.this field exist',[],'en')]]          
           ], 422);      
        
         } else{
 
 
   Post::find($id)->update([
     //'user_name'=>$formdata['user_name'],
     'title' => $formdata['title'],
   //  'metakey' => $formdata['metakey'],
     'slug' =>Str::slug($tmpslug),
   
     'status' => isset ($formdata["status"]) ? 1 : 0,      
   ]);

   return response()->json("ok");
         }
   
    }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
     $item = Post::find($id);
      if (!( $item  === null)) {
        //delete image
        $medstor=new MediaStoreController();
        $list=MediaPost::where('post_id',$id)->get();
        foreach( $list  as $mediapost ){
          $medstor->deleteimage($mediapost->media_id);         
        }

        //delete   MediaPost records
        MediaPost::where('post_id',$id)->delete();
        LangPost::where('post_id',$id)->delete();
        Post::find($id)->delete();
      }
      return redirect()->back();
  
    }

    public function updatefooter(UpdateFooterRequest $request,$id)
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
        //check if slug exist
        // $tmpslug="";
        // if ($formdata["slug"] == "" || empty($formdata["slug"])) {
        //     $tmpslug = $formdata["title"];
        // } else {
        //     $tmpslug = $formdata["slug"];
        // }
        // $promodel=Post::where('slug', $tmpslug )->whereNot('id',$id)->first();
        // if (!is_null($promodel)) {
        //     // error
        //    return response()->json([
        //      "errors" =>  ["slug" => [__('messages.this field exist',[],'en')]]          
        //    ], 422);      
        
        //  } else
       //  {
 
 
   Post::find($id)->update([
     //'user_name'=>$formdata['user_name'],
    // 'title' => $formdata['title'],
   //  'metakey' => $formdata['metakey'],
   //  'slug' =>Str::slug($tmpslug),
   
     'status' => isset ($formdata["status"]) ? 1 : 0,      
   ]);

   return response()->json("ok");
         }
   
   // }
    }
    public function showbycatid($id)
    {
      //  $strgCtrlr = new StorageController(); 
        //$path= $strgCtrlr->SitePath('image');
        //etfootersections
      
//temp
$category=Category::find($id);
          $list = Post::where('category_id',$id)->get();       
              
         return view("admin.post.show", [          
         "list"=>   $list,    "category"=>   $category,          
         ]);
      
     


        
    }
    public function translate()
    {
      
$category=Category::where('code','translate')->first();
          $list = Post::where('category_id',$category->id)->get();       
              
         return view("admin.post.show", [          
         "list"=>   $list,    "category"=>   $category,          
         ]);
      
     


        
    }

    public function uploadLargeFiles(Request $request) {
      $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));
  
      if (!$receiver->isUploaded()) {
          // file not uploaded
      }
  
      $fileReceived = $receiver->receive(); // receive file
      if ($fileReceived->isFinished()) { 
       // $formdata=$request->fdata;
        // file uploading is complete / all chunks are uploaded
          $file = $fileReceived->getFile(); // get file
           $strgCtrlr=new  StorageController();

          $ext = $file->getClientOriginalExtension();
          $filename = rand(10000, 99999) . '.' . $ext;
          $path = $strgCtrlr->path['posts'];
          $path = $file->storeAs($path, $filename, 'public');
          $cap="";
          // if(isset( $formdata->caption)){
          //   $cap=$formdata->caption;
   
          // } 
          $DataArr = [];
      //    parse_str($formdata,$DataArr);
          // $filename = str_replace('.'.$ext, '', $file->getClientOriginalName()); //file name without extenstion
          // $filename .= '_' . md5(time()) . '.' . $ext; // a unique file name
  
          // $disk = Storage::disk(config('filesystems.default'));
          // $path = $disk->putFileAs('videos', $file, $filename);
  
          // delete chunked file
        unlink($file->getPathname());
          return [
              'path' => asset('storage/' . $path),
              'filename' => $filename,
             // 'descdata'=> $formdata,
              //'caption'=>  $DataArr['caption'],
          ];
      }
  
      // otherwise return percentage information
      $handler = $fileReceived->handler();
      return [
          'done' => $handler->getPercentageDone(),
          'status' => true
      ];
  }

}
